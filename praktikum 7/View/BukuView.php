<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="container">
        <h1>Daftar Buku</h1>
        <div class="my-3">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">
                <i class="bi-plus-circle-fill"></i>Tambah</button>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <?php foreach ($data->getKolomTabel() as $kolom): ?>
                                <th scope="col">
                                    <?php echo $kolom ?>
                                </th>
                            <?php endforeach; ?>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0; ?>
                        <?php foreach ($data->getData() as $buku): ?>
                            <tr>
                                <td><?php echo ++$no; ?></td>
                                <td><?php echo $buku->getJudul(); ?></td>
                                <td><?php echo $buku->getPengarang(); ?></td>
                                <td><?php echo $buku->getPenerbit(); ?></td>
                                <td><?php echo $buku->getTahun(); ?></td>
                                <td>
                                    <a href="/index.php/edit?id=<?php echo $buku->getId();?>" class="btn btn-succes"><i class="bi-pencil-square"></i>Edit</a>
                                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal"data-bs-id="<?php echo $buku->getId();?>"><i class="bi-trash"></i>Hapus</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="tambahModalLabel">Form Tambah Buku</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form action="/index.php/buku/simpan" id="formtambah" method="POST">
                <div class="mb-3">
                    <tabel for="judul">Judul</label>
                    <input type="text" name="judul" id="judul"
                     class="form-control">
                </div>
                <div class="mb-3">
                    <tabel for="pengarang">Pengarang</label>
                    <input type="text" name="pengarang" id="pengarang"
                     class="form-control">
                </div>
                <div class="mb-3">
                    <tabel for="penerbit">Penerbit</label>
                    <input type="text" name="penerbit" id="penerbit"
                     class="form-control">
                </div>
                <div class="mb-3">
                    <tabel for="tahun">Tahun</label>
                    <input type="text" name="tahun" id="tahun"
                     class="form-control">
                </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" form="formatTambah" class="btn btn-primary"><i class="bi bi-floppy"></i>simpan</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal hapus-->
<div class="modal fade" id="hapusModal" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="hapusModalLabel">Konfirmasi Hapus</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/index.php/buku/hapus" id="formHapus" method="POST">
            <input type="hidden" name="id_hapus" id="hidden_id"> 
        </form>
        <p>Apakah anda yakin ingin menghapus data dengan id <span
        id="text_id">1</span>?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" form="formHapus" class="btn btn-danger"><i class="bi-bi-trash"></i>Hapus</button>
      </div>
    </div>
  </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script>
        const exampleModal = document.getElementById('hapusModal')
  hapusModal.addEventListener('show.bs.modal', event => {
    // Button that triggered the modal
    const button = event.relatedTarget
    // Extract info from data-bs-* attributes
    const id = button.getAttribute('data-bs-id')
    // If necessary, you could initiate an Ajax request here
    // and then do the updating in a callback.
    //
    // Update the modal's content.
    const hidden_id = hapusModal.querySelector('.modal-title')
    const text_id = hapusModal.querySelector('.modal-body input')

    hidden_id.value = id;
    text_id.textContent = id;
  })
    </script>
</body>
</html>