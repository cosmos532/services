{{ Form::hidden('user_id', auth()->user()->id) }}
{{ Form::hidden('email', auth()->user()->email) }}
{{ Form::hidden('status', 'CREATED') }}
{{ Form::hidden('type', 'BOOKING') }}

<div class="card-body">

    <div class="table mt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="item-row">
                                <th>{{ __('Quantity') }}</th>
                                <th>{{ __('Description') }}</th>
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('Time') }}</th>
                                <th>{{ __('Price') }}</th>
                                <th>{{ __('Total') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="rows">
                        <tr class="item-row" id="row_1">
                            <td class="col-1">
                                <input class="form-control qty" name="quantity[]" id="quantity_1" value="1" type="text" readonly="readonly">
                            </td>
                            <td class="col-4">
                                <select class="form-control" name="service_id[]" id="service_id_1" onchange='changePrice(event);'>
                                </select>
                            </td>
                            <td class="col-2">
                                <input
                                    type="text"
                                    id="datepicker_1"
                                    name="date[]"
                                    class="form-control date"
                                    placeholder="{{ __('Select') }}"
                                    onfocus="(this.type='date')"
                                    onblur="(this.type='text')"
                                    onchange="validate(1)"
                                >
                                <span class="text-danger" id="date-response_1"></span>
                            </td>
                            <td class="col-2">
                                <select class="form-control" name="time[]" id="time_1" onchange="validate(1)">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    <option value="06:00">06:00</option>
                                    <option value="06:30">06:30</option>
                                    <option value="07:00">07:00</option>
                                    <option value="07:30">07:30</option>
                                    <option value="08:00">08:00</option>
                                    <option value="08:30">08:30</option>
                                    <option value="09:00">09:00</option>
                                    <option value="09:30">09:30</option>
                                    <option value="10:00">10:00</option>
                                    <option value="10:30">10:30</option>
                                    <option value="11:00">11:00</option>
                                    <option value="11:30">11:30</option>
                                    <option value="12:00">12:00</option>
                                    <option value="12:30">12:30</option>
                                    <option value="13:00">13:00</option>
                                    <option value="13:30">13:30</option>
                                    <option value="14:00">14:00</option>
                                    <option value="14:30">14:30</option>
                                    <option value="15:00">15:00</option>
                                    <option value="15:30">15:30</option>
                                    <option value="16:00">16:00</option>
                                    <option value="16:30">16:30</option>
                                    <option value="17:00">17:00</option>
                                    <option value="17:30">17:30</option>
                                    <option value="18:00">18:00</option>
                                    <option value="18:30">18:30</option>
                                    <option value="19:00">19:00</option>
                                    <option value="19:30">19:30</option>
                                    <option value="200:00">20:00</option>
                                </select>
                            </td>
                            <td class="col-2">
                                <input class="form-control price" name="price[]" id="price_1" step="0.00" placeholder="Precio" type="number" value="" readonly="readonly">
                            </td>
                            <td class="col-1">
                                <span class="total">0.00</span>
                            </td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                    <a id="addRow" href="javascript:;" title="Add a row" class="btn btn-primary">Add ítem</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $("tbody").on('change', '.price', function () {
        $(this).val(function (i, v) {
            return parseFloat(v).toFixed(2);
        })
    });
</script>

<script>

    jQuery(document).ready(function(){
        jQuery().invoice({
            addRow : "#addRow",
            delete : ".delete",
            parentClass : ".item-row",

            price : ".price",
            qty : ".qty",
            total : ".total",
            totalQty: "#totalQty",

            subtotal : "#subtotal",
            subtotal_form : "#subtotal_form",
            tax: "#tax",
            tax_form : "#tax_form",
            total_tax_form: "#total_tax_form",
            discount: "#discount",
            discount_form: "#discount_form",
            total_discount_form: "#total_discount_form",
            grand_total : "#grand_total",
            grand_total_form: "#grand_total_form"
        });
    });

</script>