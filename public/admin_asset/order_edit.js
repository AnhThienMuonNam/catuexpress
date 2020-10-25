function FormViewModel(data) {
    var self = this;
    self.ImagePath = ko.observable(data.API_URLs.ImagePath || null);
    self.PublicPath = ko.observable(data.API_URLs.PublicPath || null);
    self.Order = ko.observable(data.Order || null);
    self.OrderStatues = ko.observableArray(data.OrderStatues || []);
    self.Drivers = ko.observableArray(data.Drivers || []);

    self.orderViewModel = new OrderViewModel(self);

    self.formatMoney = function(number) {
        var val = parseInt(number);
        return val.toFixed(0).replace(/./g, function(c, i, a) {
            return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "." + c : c;
        }) + " VNĐ";
    };

    self.getDriverInfo = function(driverId) {
        if (driverId) {
            var driver = data.Drivers.find(x => x.id === driverId);
            if (driver) {
                return 'Email: ' + driver.email + ' - SĐT: ' + driver.phone;
            }
        }
        return '';
    }

    self.saveOrder = function() {
        var model = self.orderViewModel.toJSON();

        $.ajaxSetup({
            headers: { 'X-CSRF-Token': $('#_token').val() }
        });
        $.ajax({
            url: data.API_URLs.SaveOrder,
            type: "POST",
            data: model,
            success: function(response) {
                if (response.IsSuccess == true) {
                    alertify.success('Cập nhật thành công');
                    location.reload();
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
        });
    };

    self.sendEmailRemindOrder = function() {
        var model = self.orderViewModel.toJSON();

        $.ajaxSetup({
            headers: { 'X-CSRF-Token': $('#_token').val() }
        });
        $.ajax({
            url: data.API_URLs.SendEmailRemindOrder,
            type: "POST",
            data: model,
            success: function(response) {
                if (response.IsSuccess == true) {
                    alertify.success('Gửi Email thành công');
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
        });
    };
}

function OrderViewModel(parent) {
    var self = this;
    var OrderData = parent.Order();

    self.id = ko.observable(OrderData.id || null);

    self.customer_name = ko.observable(OrderData.customer_name || null);
    self.no_of_passengers = ko.observable(OrderData.no_of_passengers || null);
    self.car_type = ko.observable(OrderData.car_type || null);

    self.order_status_id = ko.observable(OrderData.order_status_id || null);
    self.driver_id = ko.observable(OrderData.driver_id || null);
    self.price = ko.observable(OrderData.price || null);
    self.tour = ko.observable(OrderData.tour || null);
    self.detail = ko.observable(OrderData.detail || null);
    self.car_model = ko.observable(OrderData.car_model || null);

    self.toJSON = function() {
        var model = {
            id: ko.utils.unwrapObservable(this.id),
            order_status_id: ko.utils.unwrapObservable(this.order_status_id),
            price: ko.utils.unwrapObservable(this.price),
            detail: ko.utils.unwrapObservable(this.detail),
            driver_id: ko.utils.unwrapObservable(this.driver_id),
            car_model: ko.utils.unwrapObservable(this.car_model)
        };

        return model;
    };

}