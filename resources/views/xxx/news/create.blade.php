<form id="newsAdd">
  <div class="card">
    <div class="col-md-12">
      <div class="people mb-2">
        <span id="errorMsg" style="color: red; font-size: 1.1rem;"></span>
        <div class="tabs">
          <ul class="tab-links"></ul>
          <div class="tab-content">
            <div class="tab template-content">
              <input type="hidden" class="lang">
              <div class="form-group row mb-1">
                <label for="title" class="col-sm-3 col-form-label text-right">
                  標題：
                  <span class="text-danger">*</span>
                </label>
                <div class="col-sm-9 col-form-label">
                  <input type="text" class="form-control newsTitle"/>
                </div>
              </div>
              <div class="form-group row mb-1">
                <label for="content" class="col-sm-3 col-form-label text-right">
                  內容：
                  <span class="text-danger">*</span>
                </label>
                <div class="col-sm-9 col-form-label">
                  <textarea class="news_content newsContent"></textarea>
                </div>
              </div>
            </div>
          </div>
        </div>
        <button class="btn btn-primary btn-lg btn-block mt-4">建立</button>
      </div>
    </div>
  </div>
</form>