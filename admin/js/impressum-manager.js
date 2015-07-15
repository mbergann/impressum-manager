(function ($) {
    $(document).ready(function () {

        var hash = window.location.hash.substring(1);

        $(".nav-tab").click(function () {
            triggerTab(this, $(this).attr("id"));
        });

        if (hash.length) {
            hash = hash.replace("-j","");
            triggerTab($("#" + hash), hash);
        } else {
            triggerTab($("#general-tab"), "general-tab");
        }

        function triggerTab(o, name) {
            $(".tab").hide();
            $(".nav-tab").removeClass("nav-tab-active");
            $(o).addClass("nav-tab-active");
            $("." + name).addClass("nav-tab-active").show();
        }

        if($("#impressum_manager_use_imported_impressum").attr("checked")) {
            $("#general-tab").hide();
            $("#settings-tab").hide();
            // hide tabs
            $(".tab").hide();
            $(".nav-tab").removeClass("nav-tab-active");
            $(".import-tab").show();
            $("#import-tab").addClass("nav-tab-active");
            $("#hidden_impressum_manager_use_imported_impressum").val("on");
            $("#import-tab").show();
        } else {
            $("#import-tab").hide();
            $("#general-tab").show();
            $("#settings-tab").show();

        }

        $("#impressum_manager_use_imported_impressum").change(function() {
            if($(this).attr("checked")) {
                $("#general-tab").hide();
                $("#settings-tab").hide();
                $("#import-tab").show();
                // hide tabs
                $(".tab").hide();
                $(".nav-tab").removeClass("nav-tab-active");
                $(".import-tab").show();
                $("#import-tab").addClass("nav-tab-active");
                $(".hidden_impressum_manager_use_imported_impressum").val("on");
            } else {
                $(".nav-tab").removeClass("nav-tab-active");
                $("#general-tab").addClass("nav-tab-active");
                $(".import-tab").hide();
                $("#import-tab").hide();
                $("#general-tab").show();
                $(".general-tab").show();
                $("#settings-tab").show();
                $(".hidden_impressum_manager_use_imported_impressum").val("");
            }
        });

    });
}(jQuery));
