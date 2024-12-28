@extends('layouts.dashboard')

@section('content')
    <h1>{{ $title }}</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        </ol>
    </nav>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addProductModal">
        Tambah Produk
    </button>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div id="product-list" class="container mb-4 mt-4 row">
        @foreach ($products as $product)
            <div class="card-group col-md-3 m-2">
                <div class="card" style="width: 18rem;">
                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top mx-auto d-block"
                        style="width: 155px; height: 150px; object-fit: center;" alt="{{ $product->name }}">
                    <div class="card-body">
                        <span class="badge badge-primary">{{ $product->category->name }}</span>
                        <h5 class="card-title">{{ $product['name'] }}</h5>
                        <p class="card-text">{{ $product['description'] }}</p>
                        <p class="card-text"><strong>Rp {{ number_format($product->price, 0, ',', '.') }}</strong></p>
                        <div class="d-flex">
                            <!-- Edit Button -->
                            <button class="btn btn-warning mr-2" data-toggle="modal" data-target="#editModal-{{ $product->id }}">Edit</button>
                            <!-- Delete Button with data-toggle for confirmation modal -->
                            <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal-{{ $product->id }}">Delete</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Modal -->
            <div class="modal fade" id="editModal-{{ $product->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Edit Produk</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Product Name -->
                                <div class="form-group">
                                    <label for="name">Nama Produk</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}" required>
                                </div>
                                <!-- Product Description -->
                                <div class="form-group">
                                    <label for="description">Deskripsi Produk</label>
                                    <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $product->description) }}</textarea>
                                </div>
                                <!-- Product Price -->
                                <div class="form-group">
                                    <label for="price">Harga Produk</label>
                                    <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}" required>
                                </div>
                                <!-- Product Category -->
                                <div class="form-group">
                                    <label for="category">Kategori Produk</label>
                                    <select class="form-control" id="category" name="category_id" required>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- Product Image -->
                                <div class="form-group">
                                    <label for="image">Gambar Produk</label>
                                    <input type="file" class="form-control" id="image" name="image" onchange="previewImage(event)">
                                </div>
                                <div class="form-group">
                                    <label for="ha">Gambar saat ini</label>
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="Image Preview" style="width: 100%; height: auto; display: block;">
                                </div>
                                <!-- Image Preview -->
                                <div class="form-group">
                                    <label for="imagePreview">Preview Gambar</label>
                                    <img id="imagePreview" src="#" alt="Image Preview" style="width: 100%; height: auto; display: none;">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Delete Confirmation Modal -->
            <div class="modal fade" id="deleteModal-{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Apakah Anda yakin ingin menghapus produk "{{ $product->name }}"?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addProductModalLabel">Tambah Produk Baru</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Product Name -->
                        <div class="form-group">
                            <label for="name">Nama Produk</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <!-- Product Description -->
                        <div class="form-group">
                            <label for="description">Deskripsi Produk</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>
                        <!-- Product Price -->
                        <div class="form-group">
                            <label for="price">Harga Produk</label>
                            <input type="number" class="form-control" id="price" name="price" required>
                        </div>
                        <!-- Product Category -->
                        <div class="form-group">
                            <label for="category">Kategori Produk</label>
                            <select class="form-control" id="category" name="category_id" required>
                                <option value="" selected disabled>Pilih kategori produk</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Product Image -->
                        <div class="form-group">
                            <label for="image">Gambar Produk</label>
                            <input type="file" class="form-control" id="image" name="image" onchange="previewImage(event)" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Tambah Produk</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const imagePreview = document.getElementById('imagePreview');
                imagePreview.style.display = 'block';
                imagePreview.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }

        $(document).ready(function() {
            $('#category').select2({
                dropdownParent: $('#exampleModal')
            });
        });
    </script>
@endsection
