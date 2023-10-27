<!DOCTYPE html>
<html>
<head>
    <title>Saved Form Data</title>
    <!-- Add Bootstrap CSS link here -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <form method="POST" action="{{ route('get-selected-inputs') }}" class="mt-5">
            @csrf
            <ul>
                @foreach ($forms as $formData)
                    @php
                        $fields = json_decode($formData, true);
                    @endphp
                    @foreach ($fields as $field)
                        @if ($field['type'] == 'autocomplete')
                        @elseif ($field['type'] == 'button')
                            <button type="{{ $field['subtype'] }}" class="btn {{ $field['className'] }}">{{ $field['label'] }}</button><br>
                        @elseif ($field['type'] == 'checkbox-group')
                            <div class="form-check">
                                @foreach ($field['values'] as $option)
                                    <label class="form-check-label">
                                        <input type="checkbox" name="{{ $field['name'] }}[]" value="{{ $option['value'] }}" class="form-check-input">
                                        {{ $option['label'] }}
                                    </label><br>
                                @endforeach
                            </div><br>
                        @elseif ($field['type'] == 'date')
                            <input type="date" name="{{ $field['name'] }}" class="form-control"><br>
                        @elseif ($field['type'] == 'file')
                            <input type="file" name="{{ $field['name'] }}" class="form-control-file" @if($field['multiple']) multiple @endif><br>
                        @elseif ($field['type'] == 'header')
                            <h1>{!! $field['label'] !!}</h1>
                        @elseif ($field['type'] == 'hidden')
                            <input type="hidden" name="{{ $field['name'] }}" value=""><br>
                        @elseif ($field['type'] == 'number')
                        number
                            <input type="number" name="{{ $field['name'] }}" class="form-control"><br>
                        @elseif ($field['type'] == 'paragraph')
                            <p>{{ $field['label'] }}</p>
                        @elseif ($field['type'] == 'radio-group')
                            <div>
                                @foreach ($field['values'] as $option)
                                    <label class="form-check-label">
                                        <input type="radio" name="{{ $field['name'] }}" value="{{ $option['value'] }}" class="form-check-input">
                                        {{ $option['label'] }}
                                    </label><br>
                                @endforeach
                            </div><br>
                        @elseif ($field['type'] == 'select')
                            <select name="{{ $field['name'] }}" class="form-control">
                                @foreach ($field['values'] as $option)
                                    <option value="{{ $option['value'] }}" @if($option['selected']) selected @endif>{{ $option['label'] }}</option>
                                @endforeach
                            </select><br>
                        @elseif ($field['type'] == 'text')
                            <input type="text" name="{{ $field['name'] }}" class="form-control"><br>
                        @elseif ($field['type'] == 'textarea')
                            <textarea name="{{ $field['name'] }}" class="form-control"></textarea><br>
                        @endif
                    @endforeach
                @endforeach
                <button type="submit" class="btn btn-primary">Submit</button>

            </ul>
        </form>
    </div>

    <!-- Add Bootstrap JS and jQuery if needed -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
