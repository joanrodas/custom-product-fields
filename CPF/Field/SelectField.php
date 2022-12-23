<?php

namespace CPF\Field;

class SelectField
{

	private $options = [];

	public function __construct(string $type, string $slug, string $name, bool $save_individual = true)
	{
		$this->type = $type;
		$this->slug = $slug;
		$this->name = $name;
		$this->options = apply_filters('cpf_select_' . $slug . '_options', []);
		$this->save_individual = $save_individual;
		add_action('woocommerce_process_product_meta', [$this, 'save']);
	}


	public static function create(string $type, string $slug, string $name)
	{
		return (new self($type, $slug, $name));
	}

	public function display()
	{
		$input = '';
		$value = get_post_meta(get_the_ID(), '_' . $this->slug, true);
		if ($this->type == 'select') {
			ob_start(); ?>
			<p class="form-field _<?= $this->type ?>_field ">
				<label for="_<?= $this->slug ?>"><?= $this->name ?></label>
				<select class="short" style="" name="_<?= $this->save_individual ? $this->slug : $this->slug . '[]' ?>" id="_<?= $this->slug ?>">
					<?php foreach ($this->options as $option_key => $option_value) : ?>
						<option value="<?= $option_key ?>" x-cloak :selected="(typeof entries !== 'undefined' && tab < entries.length) ? (entries[tab]['<?= $this->slug ?>'] === <?= $option_key ?>) : <?= $option_key == $value ? 'true' : 'false' ?>"><?= $option_value ?></option>
					<?php endforeach; ?>
				</select>
			</p>
<?php $input = ob_get_clean();
		}
		echo $input;
	}

	public function set_options($options)
	{
		if (is_callable($options)) {
			$options = call_user_func($options);
		}
		$this->options = (array) $options;
		return $this;
	}

	public function add_options($options)
	{
		if (is_callable($options)) {
			$options = (array) call_user_func($options);
		}
		$this->options = array_merge($this->options, $options);
		return $this;
	}

	public function save($product_id)
	{
		if (!$this->save_individual) return;
		
		$key = '_' . $this->slug;
		if (isset($_POST[$key])) { // phpcs:ignore
			update_post_meta($product_id, $key, $_POST[$key]); // phpcs:ignore
		}
	}
}
