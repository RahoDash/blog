
<link rel="stylesheet" href="../darkroomjs-master/build/darkroom.css">
<link rel="stylesheet" href="./darkroomjs-master/demo/css/page.css">
    <div id="content">
        <div class="container">
            <section class="copy">
                <h2 class="sr-only">Introduction</h2>
                <br/>
                <br/><br/>
                <br/>

                <div class="figure-wrapper">
                    <img src="{{asset('img/background.jpg')}}" alt="DomoKun" id="target">
                </div>
            </section>
        </div>
    </div>

<script src="./darkroomjs-master/demo/vendor/fabric.js"></script>
<script src="../darkroomjs-master/build/darkroom.js"></script>

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


