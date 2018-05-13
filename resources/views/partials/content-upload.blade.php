<section id="upload-form" class="section">
  <div class="wrapper">
    <div class="row">
      <div class="col-md-8 col-md-offset-2 col-xs-12">
        <form name="upload" method="POST" enctype="multipart/form-data" action="{{ admin_url( 'admin-post.php' ) }}">
          <div class="form-row">
            <label for="title">Title</label>
            <input type="text" name="title" />
          </div>
          <div class="form-row">
            <label for="author">Author</label>
            <input type="text" name="author" />
          </div>
          <div class="form-row">
            <label for="uploaded_by">Uploaded By</label>
            <input type="text" name="uploaded_by" />
          </div>
          <div class="form-row">
            <label for="tags">Tags (comma-separated)</label>
            <input type="text" name="tags" />
          </div>
          <div class="form-row">
            <label for="file">File</label>
            <input type="file" name="file" />
          </div>
          <div class="form-row">
            <input type="hidden" name="action" value="upload_file" />
            <input type="submit" value="Upload" />
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
