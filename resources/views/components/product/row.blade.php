@props(['isSecondary' => true])

<tr class="cloning_row">
    <td>
        @if($isSecondary)
            <x-icons.delete />
        @endif
    </td>
    <td>
        <x-form.input name="product_name[]" class="product_name"/>
    </td>
    <td>
        <label>
            <select name="unit[]" id="unit" class="unit custom-select mw-13">
                <option disabled selected>Choose...</option>
                <option value="piece">piece</option>
                <option value="g">gram</option>
                <option value="kg">kilo_gram</option>
            </select>
        </label>
        <x-form.error name="unit"/>
    </td>
    <td>
        <x-form.input type="number" name="quantity[]" class="quantity" step="1"
                      min="1"/>
    </td>
    <td>
        <x-form.input type="number" name="unit_price[]" class="unit_price"
                      step="0.01" min="0"/>
    </td>
    <td>
        <x-form.input type="number" name="row_sub_total[]" class="row_sub_total"
                      value="0.00" readonly/>
    </td>
</tr>
