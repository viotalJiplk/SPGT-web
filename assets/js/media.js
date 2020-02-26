var mediaConstructor = function () {
    this.xsm = window.matchMedia('(max-width: 575.98px)').matches;
    this.sm = window.matchMedia('(min-width: 576px) and (max-width: 767.98px)').matches;
    this.md = window.matchMedia('(min-width: 768px) and (max-width: 991.98px)').matches;
    this.lg = window.matchMedia('(min-width: 992px) and (max-width: 1199.98px)').matches;
    this.xlg = window.matchMedia('(min-width: 1200px)').matches;
    this.w = window.outerWidth;
};


var media = function () {
    return new mediaConstructor();
};