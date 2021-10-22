<!--<script src="{{asset('js/scripts/tinymce/tinymce.min.js')}}"></script>-->
<template>
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
                    <!--<textarea class="news_content newsContent"></textarea>-->
                    <editor
                      api-key="3esaegqp0ztkrjgujou1mwuqb1fjm0egp84kfugrrmwtum6e"
                      :init="{
                        height: 500,
                        menubar: false,
                        plugins: [
                          'advlist autolink lists link image charmap print preview anchor',
                          'searchreplace visualblocks code fullscreen',
                          'insertdatetime media table paste code help wordcount'
                        ],
                        toolbar:
                          'undo redo | formatselect | bold italic backcolor | \
                          alignleft aligncenter alignright alignjustify | \
                          bullist numlist outdent indent | removeformat | help'
                      }"
                    />
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
</template>
<script>
  import Editor from '@tinymce/tinymce-vue'

  export default {
    components: {
      Editor
    },
    data() {
      return {
        
      }
    },
    methods: {
      
    },
    created: function() {
      $(document).on('focusin', function(e) {
        if ($(e.target).closest(".tox-textfield").length)
          e.stopImmediatePropagation();
      })
    }
  }
</script>