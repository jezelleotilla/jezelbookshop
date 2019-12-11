
<div class="row pt-5">
  <div class="col"></div>
  <div class="col">
    <div class="card">
      <h5 class="card-header">New Book</h5>
      <div class="card-body">
          <?= \Config\Services::validation()->listErrors(); ?>
          <?php if (isset($success_message)) { ?> 
            <div class="alert alert-success"><?= $success_message ?></div>
          <?php } ?>
          <form action="create" method="POST" enctype="multipart/form-data" >
              <div class="form-group">
                <label>ISBN</label>
                <input required  type="text" name="isbn" class="form-control">
              </div>
              
              <div class="form-group">
                <label>Title</label>
                <input required type="text" name="title" class="form-control">
              </div>

              <div class="form-group">
                <label>Short Description</label>
                <textarea required name="short_description" rows="3" class="form-control"></textarea>
              </div>

              <div class="form-group">
                <label>Publication Date</label>
                <input required type="date" name="publication_date" class="form-control">
              </div>

              <div class="form-group">
                <label>Price(PHP)</label>
                <input required type="number" name="price" class="form-control">
              </div>

              <div class="form-group">
                <label>PDF file</label>
                <input required type="file" name="pdf_file" accept="application/pdf" >
              </div>

              <div class="form-group">
                <label>Cover Photo</label>
                <input required type="file" name="cover_photo" accept="image/x-png,image/jpg,image/jpeg" >
              </div>

            <button type="submit" class="btn btn-primary btn-lg">Save</button>
          </form>
      </div>
    </div>
  </div>
  <div class="col"></div>
</div>