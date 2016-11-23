/**
 * Created by Aron on 21/11/2016.
 */
$(document).ready(function() {
    var theTempalte;
    $('.grid').masonry({
        // options
        itemSelector: '.grid-item',
        columnWidth: 200
    });

    var model = {
        /**
         * Vinnur með gögn
         * setur i db
         */
        init: function () {
            $.get("template/notes.handlebars", function (data) {
                theTempalte = data;
            }).then(function () {
                // Þegar hann er buinn að ná i templatið setur hann gögnin úr Json skráni inn í kóðan
                model.getNotes();
            })
        },
        getNotes: function () {
            // Nær í kisurnar úr json skráni
            try{
                $.getJSON("assets/renderNotes.php", function (data) {
                    var Template = Handlebars.compile(theTempalte);
                    var CompiledHtml = Template(data);
                    // Render
                    $('#render').html(CompiledHtml);
                });
            }catch(e) {
                console.log(e);
            }

        }

    };

    var controller = {
        /**
         * Tengir gögn og html saman
         */

        loadNotes: function () {
            model.init();
            model.getNotes();
        }
    };

    var view = {
        /**
         * Byrtir gögn á vef
         */
        init: function () {
            model.init();
            model.getNotes();
            view.userinput();
        },
        userinput: function () {
            $("#submitnote").off('click').on('click', function () {
                var title = $("#title").val();
                var body = $("#addNote").val();
                var pinned = "0";
                console.log(title);
                console.log(body);
                console.log(pinned);

                $.ajax({
                    url: 'assets/addToNote.php',
                    data: 'title='+ title + '&body='+ body +'&pinned='+ pinned,
                    type: "POST",
                    success: function(json) {
                        console.log(json);
                        controller.loadNotes();
                    }
                });



            })
        }

    };
    /*$("#submitnote").on('click', function () {
     var note = $("#addNote").val();
     console.log(note);
     })*/
    view.init();
});
