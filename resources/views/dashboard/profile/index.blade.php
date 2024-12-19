@extends('layouts.dashboard')

@section('content')
<h1>Profile</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Profile</li>
        </ol>
    </nav>
    <form action="">
        <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $profile->name }}">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $profile->email }}">
        </div>
        @if (profile->avatar)
            <img src="{{ asset('storage/' . $profile->avatar) }}" style="width: 100px; height: 100px">
        @endif
        <div class="custom-file">
            <label for="avatar">Avatar</label>
            <input type="file" class="custom-file-input" id="inputGroupFile01">
            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        function submitForm() {
            let form = document.getElementById('product-form');
            let data = new FormData(form);

            $.ajax({
                url: $(form).attr('action'),
                type: 'POST',
                data: data,
                contentType: false,
                processData: false,
                success: function(response) {
                    window.location.reload();
                },
                error: function(response) {
                    if (response.status == 422) {
                        let errors = response.responseJSON.errors;
                        let message = '';
                        for (let key in errors) {
                            message += errors[key][0] + '\n';
                        }
                        alert(message);
                    }
                }
            });
        }

        function deleteProduct(url) {
            $.ajax({
                url: url,
                type: 'DELETE',
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    window.location.reload();
                }
            });
        }
    </script>
@endpush
