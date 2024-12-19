<!-- Modal untuk Edit -->
<div class="modal fade" id="editModal-{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel-{{ $product->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel-{{ $product->id }}">Edit Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="edit-form-{{ $product->id }}" action="{{ route('products.update', $product->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name-{{ $product->id }}" class="col-form-label">Nama Produk:</label>
                        <input type="text" class="form-control" id="name-{{ $product->id }}" name="name" value="{{ $product->name }}">

                        <label for="category-{{ $product->id }}" class="col-form-label">Kategori:</label>
                        <select name="category_id" id="category-{{ $product->id }}" class="custom-select">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>

                        <label for="description-{{ $product->id }}" class="col-form-label">Deskripsi:</label>
                        <textarea class="form-control" id="description-{{ $product->id }}" name="description">{{ $product->description }}</textarea>

                        <label for="price-{{ $product->id }}" class="col-form-label">Harga:</label>
                        <input type="text" class="form-control" id="price-{{ $product->id }}" name="price" value="{{ $product->price }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" onclick="submitForm()">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


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
