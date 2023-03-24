var MODAL = {
    /**
     * Настройки
     */
    Properties: {
        Modal:  $('#modal'),
        Title:  $('.modal-header'),
        Body:   $('.modal-body'),
        Footer: $('.modal-footer')
    },
    /**
     * Событие на кнопку
     */
    onClickListner: function () {
        $(document).on('click', '.popup-modal', function (e) {
            e.preventDefault();
            var mUrl = $(this).attr('href')
            var mData = $(this).serializeArray()
            MODAL.postRequest(mUrl, mData)
        })
    },
    /**
     * Post запрос
     * @param nUrl
     * @param nData
     */
    postRequest: function (nUrl, nData) {
        $.post({
            url: nUrl,
            data: nData,
            beforeSend: function () {
                console.log('beforeSend')
            },
            success: function (response) {
                if(response.length > 0){
                    MODAL.openModal(response);
                }
            },
            complete: function () {
                console.log('complete')
            },
            error: function (err, message, status) {
                console.error('err', err);
                console.error('message', message);
                console.error('status', status);
            }
        })
    },
    /**
     * Открыть модальное окно
     */
    openModal: function (response) {
        this.Properties.Body.empty().append(response)
        this.Properties.Modal.modal()
    },
    Init: function () {
        this.onClickListner()
    }
}

$(function () {
    MODAL.Init();
})