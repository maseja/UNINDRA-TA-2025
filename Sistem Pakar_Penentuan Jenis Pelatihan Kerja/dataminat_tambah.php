<div class="page-header">
    <h1>Tambah Data dan Minat</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if ($_POST && isset($_POST['submit'])) include 'aksi.php' ?>
        <form method="post">
            <div class="form-group">
                <label>Pilih Kategori <span class="text-danger">*</span></label>
                <select class="form-control" name="kategori" id="kategori" required>
                    <option value="">-- Pilih --</option>
                    <option value="usia">Usia</option>
                    <option value="jk">Jenis Kelamin</option>
                    <option value="pendidikan">Pendidikan</option>
                    <option value="minat">Jenis Minat</option>
                </select>
            </div>
            <div class="form-group">
                <label>Kode <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="kode" id="kode" readonly required />
            </div>
            <div class="form-group">
                <label id="label_nama">Nama <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nama" required />
            </div>
            <div class="form-group">
                <label>Keterangan</label>
                <input class="form-control" type="text" name="keterangan" />
            </div>
            <div class="form-group">
                <button class="btn btn-primary" name="submit"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=dataminat"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
const labelMap = {
    'usia': 'Usia',
    'jk': 'Jenis Kelamin',
    'pendidikan': 'Pendidikan',
    'minat': 'Jenis Minat'
};
$('#kategori').change(function() {
    var kategori = $(this).val();
    if (kategori) {
        // AJAX call to get kode
        $.get('get_kode.php', {kategori: kategori}, function(res) {
            $('#kode').val(res);
            $('#label_nama').text(labelMap[kategori] + ' *');
        });
    } else {
        $('#kode').val('');
        $('#label_nama').text('Nama *');
    }
});
</script>
