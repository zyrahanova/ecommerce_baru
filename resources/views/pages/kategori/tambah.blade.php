<h2>Tambah Kategori Baru</h2>
<form action="{{ route('category.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Nama Kategori</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="mb-3">
        <label for="slug" class="form-label">Keterangan</label>
        <textarea class="form-control" id="slug" name="slug" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Tambah</button>
</form>
