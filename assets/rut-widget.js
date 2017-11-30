
$.fn.rutWidget = function () {
    this.each(function () {
        var $this = $(this),
            opts = {
                formatOn: $this.data('rutFormatOn') || 'keyup change',
                validateOn: $this.data('rutValidateOn') || null,
            };
        $this.rut(opts)
            .val($.formatRut($this.val()));
    });
    return this;
};

$(function () {
    $('[data-rut]').rutWidget();
});
