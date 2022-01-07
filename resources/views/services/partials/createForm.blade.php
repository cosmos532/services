<div class="card-body">
    <div class="table mt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Description') }}</th>
                                <th>{{ __('Type') }}</th>
                                <th>{{ __('Price') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input class="form-control" type="text" name="name" placeholder="{{ __('Service name') }}">
                                </td>
                                <td>
                                    <input class="form-control" type="text" name="description" placeholder="{{ __('Description') }}">
                                </td>
                                <td>
                                    <select class="form-control" name="type" id="type">
                                        <option value="" selected>{{ __('Select') }}</option>
                                        <option value="1">{{ __('Fixed price') }}</option>
                                        <option value="0">{{ __('Check price') }}</option>
                                    </select>
                                </td>
                                <td>
                                    <input class="form-control" type="text" name="price" id="price" placeholder="{{ __('Price') }}">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12 mt-4 text-center">
            <button class="btn btn-success">{{ __('Make a service') }}</button>
        </div>
    </div>
</div>

<script>
    $("#price").change( function() {
        $(this).val(function (i, v) {
            return parseFloat(v).toFixed(2);
        })
    });
</script>

<script>
    $( function() {
        $("#type").change( function() {
            if ($(this).val() === "0") {
                $("#price").prop("disabled", true);
            } else {
                $("#price").prop("disabled", false);
            }
        });
    });
</script>
