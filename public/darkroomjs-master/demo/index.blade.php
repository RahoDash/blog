<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>DarkroomJS</title>
  <link rel="stylesheet" href="../build/darkroom.css">
  <link rel="stylesheet" href="./css/page.css">
</head>
<body>
  <div id="content">
    <div class="container">
      <section class="copy">
        <div class="figure-wrapper">
          <figure class="image-container target">
            <img src="../../img/img.jpeg" alt="DomoKun" id="target">

            <figcaption class="image-meta">
              <a target="_blank" href="http://www.flickr.com/photos/bentorode/5176910387/">
                ©
                <strong class="image-meta-title">DomoKun</strong>
                by
                <em class="image-meta-author">Ben Torode</em>
              </a>
            </figcaption>
          </figure>
        </div>
      </section>
    </div>
  </div>

  <script src="./vendor/fabric.js"></script>
  <script src="../build/darkroom.js"></script>

  <script>
    var dkrm = new Darkroom('#target', {
      // Size options
      minWidth: 100,
      minHeight: 100,
      maxWidth: 600,
      maxHeight: 500,
      ratio: 4/3,
      backgroundColor: '#000',

      // Plugins options
      plugins: {
        //save: false,
        crop: {
          quickCropKey: 67, //key "c"
          //minHeight: 50,
          //minWidth: 50,
          //ratio: 4/3
        }
      },

      // Post initialize script
      initialize: function() {
        var cropPlugin = this.plugins['crop'];
        // cropPlugin.selectZone(170, 25, 300, 300);
        cropPlugin.requireFocus();
      }
    });
  </script>
</body>
</html>
