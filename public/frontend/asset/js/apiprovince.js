const host = "https://provinces.open-api.vn/api/";

// Hàm gọi API tỉnh
var callAPI = (api) => {
    return axios.get(api)
        .then((response) => {
            console.log(response.data); // Kiểm tra dữ liệu trả về
            renderData(response.data, "city");
        })
        .catch((error) => {
            console.error("Lỗi khi lấy dữ liệu tỉnh:", error);
        });
};

// Hàm gọi API quận/huyện
var callApiDistrict = (api) => {
    return axios.get(api)
        .then((response) => {
            console.log(response.data); // Kiểm tra dữ liệu trả về
            renderData(response.data.districts, "district");
        })
        .catch((error) => {
            console.error("Lỗi khi lấy dữ liệu quận/huyện:", error);
        });
};

// Hàm gọi API phường/xã
var callApiWard = (api) => {
    return axios.get(api)
        .then((response) => {
            console.log(response.data); // Kiểm tra dữ liệu trả về
            renderData(response.data.wards, "ward");
        })
        .catch((error) => {
            console.error("Lỗi khi lấy dữ liệu phường/xã:", error);
        });
};

// Hàm render dữ liệu vào các dropdown
var renderData = (array, select) => {
    let row = '<option disable value="">Chọn</option>';
    array.forEach(element => {
        row += `<option data-id="${element.code}" value="${element.name}">${element.name}</option>`;
    });
    document.querySelector("#" + select).innerHTML = row;
};

// Lấy dữ liệu cho tỉnh khi trang tải
callAPI(host + 'p/?depth=1');

// Xử lý khi chọn tỉnh
$("#city").change(() => {
    const cityId = $("#city").find(':selected').data('id'); // Lấy id của tỉnh
    console.log("City ID: ", cityId); // Kiểm tra ID tỉnh
    if (cityId) {
        callApiDistrict(host + "p/" + cityId + "?depth=2");
        $("#district").html('<option value="">Chọn Quận/Huyện</option>');
        $("#ward").html('<option value="">Chọn Phường/Xã</option>');
    }
});

// Xử lý khi chọn huyện
$("#district").change(() => {
    const districtId = $("#district").find(':selected').data('id'); // Lấy id của huyện
    console.log("District ID: ", districtId); // Kiểm tra ID huyện
    if (districtId) {
        callApiWard(host + "d/" + districtId + "?depth=2");
        $("#ward").html('<option value="">Chọn Phường/Xã</option>');
    }
});

// Xử lý khi chọn phường/xã
$("#ward").change(() => {
    // Có thể thêm logic nếu cần xử lý khi chọn phường/xã
});
