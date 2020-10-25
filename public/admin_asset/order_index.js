function FormViewModel(data) {
    var self = this;
    self.Orders = ko.observableArray([]);
    self.OrderStatuses = ko.observableArray(data.OrderStatuses || []);
    self.Drivers = ko.observableArray(data.Drivers || []);
    self.Tours = ko.observableArray(data.Tours || []);

    self.searchViewModel = new SearchViewModel();

    self.search = function() {
        const model = self.searchViewModel.toJSON();
        $.ajaxSetup({
            headers: { 'X-CSRF-Token': $('#_token').val() }
        });
        $.ajax({
            url: data.API_URLs.SearchOrder,
            type: "POST",
            data: model,
            beforeSend: function() {
                NProgress.set(0.75);
            },
            success: function(response) {
                if (response) {
                    self.Orders(response.Orders);
                }
            },
            error: function(xhr, error) {
                console.log(xhr.responseText);
                // alert("Something went wrong :(")
            },
            complete: function() {
                NProgress.done();
            },
        });
    };

    self.formatMoney = function(number) {
        var val = parseInt(number);
        return val.toFixed(0).replace(/./g, function(c, i, a) {
            return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "." + c : c;
        }) + "đ";
    };

    self.changeSFromDate = function() {
        self.searchViewModel.fromDate($('#sFromDate').val());
    };

    self.changeSToDate = function() {
        self.searchViewModel.toDate($('#sToDate').val());
    };

    function init() {
        self.search();
    }

    init();
}

function SearchViewModel() {
    var self = this;
    self.id = ko.observable('');
    self.keyword = ko.observable('');
    self.fromDate = ko.observable(null);
    self.toDate = ko.observable(null);
    self.orderStatusId = ko.observable(null);
    self.tourId = ko.observable(null);
    self.driverId = ko.observable(null);

    SearchViewModel.prototype.toJSON = function() {
        return {
            id: ko.utils.unwrapObservable(this.id),
            keyword: ko.utils.unwrapObservable(this.keyword),
            fromDate: ko.utils.unwrapObservable(this.fromDate),
            toDate: ko.utils.unwrapObservable(this.toDate),
            orderStatusId: ko.utils.unwrapObservable(this.orderStatusId),
            tourId: ko.utils.unwrapObservable(this.tourId),
            driverId: ko.utils.unwrapObservable(this.driverId)
        }
    }
}