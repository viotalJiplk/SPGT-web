var ww = $(window);
var standardDateFormat = 'DD.MM.YYYY HH:mm';

$.fn.dataTable.ext.type.order['momentDate-pre'] = function (data) {
    return moment(data, standardDateFormat).toDate().getTime();
};

function initDatatable(table, extendSettings) {
    var dt = table.DataTable($.extend(true, {
        fixedHeader: true,
        language: {
            "sEmptyTable": "Tabulka neobsahuje žádná data",
            "sInfo": "Zobrazuji _START_ až _END_ z celkem _TOTAL_ záznamů",
            "sInfoEmpty": "Zobrazuji 0 až 0 z 0 záznamů",
            "sInfoFiltered": "(filtrováno z celkem _MAX_ záznamů)",
            "sInfoPostFix": "",
            "sInfoThousands": " ",
            "sLengthMenu": "Zobraz záznamů _MENU_",
            "sLoadingRecords": "Načítám...",
            "sProcessing": "Provádím...",
            "sSearch": "Hledat:",
            "sZeroRecords": "Žádné záznamy nebyly nalezeny",
            "oPaginate": {
                "sFirst": "První",
                "sLast": "Poslední",
                "sNext": "Další",
                "sPrevious": "Předchozí"
            },
            "oAria": {
                "sSortAscending": ": aktivujte pro řazení sloupce vzestupně",
                "sSortDescending": ": aktivujte pro řazení sloupce sestupně"
            }
        }
    }, extendSettings));

    var checkFixedHeaderVisibility = function () {
        var m = media();
        if (m.lg || m.xlg) {
            dt.fixedHeader.enable();
        }
        else {
            dt.fixedHeader.disable();
        }
    };

    var resizeTimeout = null;
    $(window).resize(function () {
        this.clearTimeout(resizeTimeout);
        resizeTimeout = this.setTimeout(function () {
            checkFixedHeaderVisibility();
        }, 250);
    }).trigger('resize');

    dt.on('draw.dt', function () {
        checkFixedHeaderVisibility();
    });

    return dt;
}


function initSummernote(textarea, extendSettings) {
    return textarea.summernote($.extend(true, {
        disableDragAndDrop: true,
        lang: "cs-CZ",
        toolbar: [
            ["style", ["style", "bold", "italic", "underline"]],
            ["font", ["superscript", "subscript"]],
            ["color", ["color"]],
            ["para", ["paragraph"]],
            ["insert", ["link", "picture"]],
            ["view", ["undo", "redo", "fullscreen"]],
        ],
        popover: {
            link: [
                ["link", ["linkDialogShow", "unlink"]]
            ],
            table: [
                ["add", ["addRowDown", "addRowUp", "addColLeft", "addColRight"]],
                ["delete", ["deleteRow", "deleteCol", "deleteTable"]],
            ],
            air: [
                ["color", ["color"]],
                ["font", ["bold", "underline", "clear"]],
                ["para", ["paragraph"]],
                ["table", ["table"]],
                ["insert", ["link"]]
            ]
        },
        height: 150
    }, extendSettings)).on("summernote.init", function () {
        var $this = $(this);
        if ($this.val().length === 0) {
            $this.summernote("insertParagraph");
        }
    });
}


$(document).ready(function () {
    var header = $(".header");
    var headerIsSmaller = header.hasClass('header-smaller');

    var upto = $(".upto");
    var changingBackgroundNaturalRatio = 2272 / 1704;

    $(document).tooltip({
        selector: '[title]',
        placement: 'bottom',
        offset: 0,
        trigger: 'hover'
    }).on('click focus', '[title]', function (e) {
        $(e.currentTarget).tooltip('hide');
    });


    upto.on('click', function () {
        $('html, body').animate({
            scrollTop: $("body").offset().top
        }, 800);
    });

    var headerPageNavigator = $(".header-page-navigator a", header);
    headerPageNavigator.on('click', function (_e, dur) {
        $('html, body').animate({
            scrollTop: header.innerHeight() + 1
        }, dur === 0 ? dur : dur || 800);
    });

    var lazy = $('.lazy');
    var loaderSrc = lazy.first('[src]').attr('src');

    var linkStyleChangingBackground = $('link#changingBackgroundStylesheet');

    var maxStyleChangingBackgroundIndex = parseInt($('input[name="changingBackgroundsCount"]').val()) - 1;
    var styleChangingBackgroundIndex = parseInt($('input[name="randomChangingBackgroundIndex"]').val());

    setInterval(function () {
        if (styleChangingBackgroundIndex < maxStyleChangingBackgroundIndex) {
            styleChangingBackgroundIndex += 1;
        }
        else {
            styleChangingBackgroundIndex = 0;
        }

        linkStyleChangingBackground.attr('href', function (_x, y) {
            var arr = y.split('\/');
            arr[arr.length - 1] = 'changingBackground' + styleChangingBackgroundIndex + '.css';
            return arr.join('\/');
        });
    }, headerIsSmaller ? 50 * 1000 / 2 : 25 * 1000 / 2);

    ww.resize(function () {
        var m = media();
        if (m.sm || m.xsm || m.md) {
            header.css('height', 'initial');
        }
        else if (headerIsSmaller) {
            header.height(3 * this.innerHeight / 5);
        }
        else if (this.innerWidth / this.innerHeight > changingBackgroundNaturalRatio) {
            header.height(this.innerHeight);
        } else {
            header.height(Math.floor(this.innerWidth / changingBackgroundNaturalRatio));
        }

    }).scroll(function () {
        if ($(this).scrollTop() > header.innerHeight()) upto.fadeIn(150);
        else upto.fadeOut(150);
    }).trigger('scroll').trigger('resize');


    $(document).on('click', function (event) {
        $(event.target).closest(".navbar").length || $(".navbar-collapse.show").length && $(".navbar-collapse.show").collapse("hide");
    });

    $('.collapse').on('hide.bs.collapse show.bs.collapse', function () {
        var icon = $('i.fa.fa-angle-down, i.fa.fa-angle-up', $('[data-target=".collapse#' + this.id + '"]'));
        if (icon.hasClass('fa-angle-up')) {
            icon.addClass('fa-angle-down').removeClass('fa-angle-up');
        }
        else {
            icon.addClass('fa-angle-up').removeClass('fa-angle-down');
        }
    });

    var confirmModal = $('.modal.modal-confirm');

    window.initAndDisplayModalConfirm = function (confirmUrl, confirmText) {
        $('.modal-body', confirmModal).text(confirmText);
        $('.btn-ok', confirmModal).attr('href', confirmUrl);
        confirmModal.modal('show');
    };

    $('[data-confirm]').on('click', function (e) {
        var $this = $(this);
        window.initAndDisplayModalConfirm($this.attr('href'), $this.data('confirm-text'));
        e.preventDefault();
        return false;
    });

});   // do not delete