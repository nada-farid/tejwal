<table>
    @foreach($speaking_languages as $speaking_language)
        <tr>
            @php
            $name='name_'.app()->getlocale();
            @endphp
            <td><input {{ $speaking_language->level ? 'checked' : null }} data-id="{{ $speaking_language->id }}" type="checkbox" class="levels-enable"></td>
            <td>{{ $speaking_language->$name }}</td>
           <!-- <td><input value="{{ $speaking_language->level ?? null }}" {{ $speaking_language->level ? null : 'disabled' }} data-id="{{ $speaking_language->id }}" name="levels[{{ $speaking_language->id }}]" type="text" class="levels-amount form-control" placeholder="Amount"></td>-->
     
          <td> <select class="form-control select2 {{ $errors->has('levels') ? 'is-invalid' : '' }}" value="{{ $speaking_language->level ?? null }}"  data-id="{{ $speaking_language->id }}" name="levels[{{ $speaking_language->id }}]" {{ $speaking_language->level ? null : 'disabled' }} data-id="{{ $speaking_language->id }}">
            @foreach(App\Models\Guide::LEVELS_RADIO as $key => $label)
                <option value="{{ $key }}" >{{ trans('global.levels.'.$label) }}</option>
            @endforeach
        </select></td>
        </tr>
    @endforeach
</table>

@section('scripts')
    @parent
    <script>
        $('document').ready(function () {
            $('.levels-enable').on('click', function () {
                let id = $(this).attr('data-id')
                let enabled = $(this).is(":checked")
                $('.select2[data-id="' + id + '"]').attr('disabled', !enabled)
                $('.select2[data-id="' + id + '"]').val(null)
            })
        });
    </script>
@endsection