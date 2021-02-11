$(document).ready(function () {
    "use strict"; // Start of use strict
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    if($('#ckeditor').length){
      CKEDITOR.replace('ckeditor', {
          contentsLangDirection: '',
          toolbarGroups: [{
            "name": "basicstyles",
            "groups": ["basicstyles"]
          },
          {
            "name": "links",
            "groups": ["links"]
          },
          {
            "name": "paragraph",
            "groups": ["list", "blocks"]
          },
          {
            "name": "document",
            "groups": ["mode"]
          },
          {
            "name": "insert",
            "groups": ["insert"]
          },
          {
            "name": "styles",
            "groups": ["styles"]
          },
          {
            "name": "about",
            "groups": ["about"]
          }
        ],
      });
    }
    if($('#ckeditor2').length){
      CKEDITOR.replace('ckeditor2', {
          contentsLangDirection: '',
          toolbarGroups: [{
            "name": "basicstyles",
            "groups": ["basicstyles"]
          },
          {
            "name": "links",
            "groups": ["links"]
          },
          {
            "name": "paragraph",
            "groups": ["list", "blocks"]
          },
          {
            "name": "document",
            "groups": ["mode"]
          },
          {
            "name": "insert",
            "groups": ["insert"]
          },
          {
            "name": "styles",
            "groups": ["styles"]
          },
          {
            "name": "about",
            "groups": ["about"]
          }
        ],
      });
    }
    if($('#ckeditor3').length){
      CKEDITOR.replace('ckeditor3', {
          contentsLangDirection: '',
          toolbarGroups: [{
            "name": "basicstyles",
            "groups": ["basicstyles"]
          },
          {
            "name": "links",
            "groups": ["links"]
          },
          {
            "name": "paragraph",
            "groups": ["list", "blocks"]
          },
          {
            "name": "document",
            "groups": ["mode"]
          },
          {
            "name": "insert",
            "groups": ["insert"]
          },
          {
            "name": "styles",
            "groups": ["styles"]
          },
          {
            "name": "about",
            "groups": ["about"]
          }
        ],
      });
    }
    if($('#ckeditor4').length){
      CKEDITOR.replace('ckeditor4', {
          contentsLangDirection: '',
          toolbarGroups: [{
            "name": "basicstyles",
            "groups": ["basicstyles"]
          },
          {
            "name": "links",
            "groups": ["links"]
          },
          {
            "name": "paragraph",
            "groups": ["list", "blocks"]
          },
          {
            "name": "document",
            "groups": ["mode"]
          },
          {
            "name": "insert",
            "groups": ["insert"]
          },
          {
            "name": "styles",
            "groups": ["styles"]
          },
          {
            "name": "about",
            "groups": ["about"]
          }
        ],
      });
    }
});