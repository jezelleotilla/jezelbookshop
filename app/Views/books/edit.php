
<div class="row pt-5">
  <div class="col"></div>
  <div class="col">
    <div class="card">
      <h5 class="card-header">Edit Book</h5>
      <div class="card-body">
          <?= \Config\Services::validation()->listErrors(); ?>
          <?php if (isset($success_message)) { ?> 
            <div class="alert alert-success"><?= $success_message ?></div>
          <?php } ?>
          <form action="" method="POST" enctype="multipart/form-data" >

              <div class="form-group">
               <img class="card-img-top" height='200' src="<?= base_url().'jezelbookshop/public/uploads/'.$book['cover_photo'] ?>" />
                <label>Cover Photo</label>
                <input type="file" name="cover_photo" accept="image/x-png,image/jpg,image/jpeg" >
              </div>

              <div class="form-group">
                <label>ISBN</label>
                <input required  type="text" name="isbn" value="<?= $book['isbn'] ?>" class="form-control">
              </div>
              
              <div class="form-group">
                <label>Title</label>
                <input required type="text" name="title" value="<?= $book['title'] ?>" class="form-control">
              </div>

              <div class="form-group">
                <label>Short Description</label>
                <textarea required name="short_description" rows="3" class="form-control"><?= $book['short_description'] ?></textarea>
              </div>

              <div class="form-group">
                <label>Publication Date</label>
                <input required type="date" name="publication_date" value="<?= $book['publication_date'] ?>" class="form-control">
              </div>

              <div class="form-group">
                <label>Price(PHP)</label>
                <input required type="number" name="price" value="<?= $book['price'] ?>" class="form-control">
              </div>

              <div class="form-group">
                <label>PDF file</label>
                <input  type="file" name="pdf_file" accept="application/pdf" >
              </div>

              <button type="submit" class="btn btn-primary btn-lg">Update</button>
          </form>
      </div>
    </div>
  </div>
  <div class="col"></div>
</div>