function FormViewModel(data) {
    var self = this;
    var IsEditMode = false;
    self.ImagePath = ko.observable(data.API_URLs.ImagePath || null);
    self.API_URLs = ko.observable(data.API_URLs || null);
    self.Cars = ko.observableArray(data.Cars || [])
    self.itemModel = ko.observable(null);
    self.removeCar = function(obj) {
        alertify.confirm("Xác nhận", "Bạn có chắc chắn muốn xóa?",
            function() {
                $.ajaxSetup({
                    headers: { 'X-CSRF-Token': $('#_token').val() }
                });
                $.ajax({
                    url: data.API_URLs.DeleteCar,
                    type: "POST",
                    data: { id: obj.id },
                    success: function(response) {
                        if (response.IsSuccess == true) {
                            self.Cars.remove(obj);
                            alertify.success("Đã xoá thành công");
                        }
                        if (response.IsSuccess === false) {
                            alertify.error("Xoá thất bại");
                        }
                    },
                    error: function(xhr, error) {

                    },
                });
            },
            function() {

            });
    };
    self.NotifyErrors = ko.observable('');

    self.createView = function() {
        IsEditMode = false;
        self.itemModel(new ItemModel(null, self));
        $('#modal-car').modal('toggle');
    }

    self.editView = function(data) {
        IsEditMode = true;
        self.itemModel(new ItemModel(data, self));
        $('#modal-car').modal('toggle');
    }

    self.saveEdit = function() {
        var _url = IsEditMode == true ? data.API_URLs.EditCar : data.API_URLs.CreateCar;
        var _message = IsEditMode == true ? 'Cập nhật thành công' : 'Thêm thành công';

        var model = self.itemModel().toJSON();
        $.ajaxSetup({
            headers: { 'X-CSRF-Token': $('#_token').val() }
        });
        $.ajax({
            url: _url,
            beforeSend: function() {
                NProgress.start();
            },
            type: "POST",
            data: model,
            success: function(data) {
                if (data.IsSuccess == true) {
                    alertify.success(_message);
                }
            },
            error: function(xhr, error) {
                let responseJSON = xhr.responseJSON;
                let commaKey = '';
                for (var key in responseJSON) {
                    if (responseJSON.hasOwnProperty(key)) {
                        self.NotifyErrors(self.NotifyErrors() + commaKey + responseJSON[key][0]);
                        commaKey = ', ';
                    }
                }
            },
            complete: function() {
                NProgress.done();
            },
        });
    }

    self.formatMoney = function(number) {
        var val = parseInt(number);
        return val.toFixed(0).replace(/./g, function(c, i, a) {
            return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "." + c : c;
        }) + "(đ)";
    };
}

function ItemModel(data, parent) {
    var self = this;
    self.id = ko.observable(data && data.id ? data.id : '');
    self.name = ko.observable(data && data.name ? data.name : '');
    self.image = ko.observable(data && data.image ? data.image : '');
    self.is_active = ko.observable(data && data.is_active == 1 ? true : false);
    self.home_page_show = ko.observable(data && data.home_page_show == 1 ? true : false);

    self.uploadImages = function() {
        var file_data = $('#uploadFile').prop('files')[0];
        var form_data = new FormData();
        form_data.append('uploadFile', file_data);
        $.ajaxSetup({
            headers: { 'X-CSRF-Token': $('#_token').val() }
        });

        $.ajax({
            url: parent.API_URLs().UploadImage,
            beforeSend: function() {
                NProgress.set(0.75);
            },
            type: "POST",
            data: form_data,
            cache: false,
            contentType: false,
            processData: false,
            success: function(res) {
                self.image(res);
                $('#uploadFile').val("");
            },
            error: function(xhr, error) {},
            complete: function() {
                NProgress.done();
            },
        });
    };

    self.toJSON = function() {
        var model = {
            id: ko.utils.unwrapObservable(this.id),
            name: ko.utils.unwrapObservable(this.name),
            image: ko.utils.unwrapObservable(this.image),
            is_active: ko.utils.unwrapObservable(this.is_active() == true ? 1 : 0),
            home_page_show: ko.utils.unwrapObservable(this.home_page_show() == true ? 1 : 0)
        };

        return model;
    };
}