<?php

namespace CPF\Field;

class RangeField extends Field
{
	use Traits\NumericType;
	use Traits\Datalist;

	public function __construct(string $type, string $slug, string $name)
	{
		parent::__construct($type, $slug, $name);
		$this->default_value = $this->min;
	}

	public function display()
	{
		ob_start(); ?>
		<p x-data="{ 
                field_name: field_name + '_<?= $this->slug ?>', 
                field_value: section_fields[field_name] !== undefined ? section_fields[field_name] : '<?= $this->default_value ?>' 
            }"
			class="form-field _<?= $this->type ?>_field">
			<label :for="field_name"><?= $this->name ?></label>
			<input x-cloak
				type="range"
				min="<?= $this->min ?>"
				max="<?= $this->max ?>"
				step="<?= $this->step ?>"
				<?php if (!empty($this->datalist)): ?>
				:list="field_name + '_datalist'"
				<?php endif; ?>
				class="short"
				:name="field_name"
				:id="field_name"
				x-model="field_value">
			<span x-text="field_value"></span> <!-- Displays the current value -->
			<?php if (!empty($this->datalist)): ?>
				<datalist :id="field_name + '_datalist'">
					<?php foreach ($this->datalist as $option): ?>
						<option value="<?= $option ?>"></option>
					<?php endforeach; ?>
				</datalist>
			<?php endif; ?>
		</p>
<?php echo ob_get_clean();
	}

	public function save($product_id, $parent = '')
	{
		$key = $parent . '_' . $this->slug;
		$value = isset($_POST[$key]) ? floatval($_POST[$key]) : $this->default_value;
		update_post_meta($product_id, $key, $value);
	}
}
