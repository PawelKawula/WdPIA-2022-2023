const modal = new bootstrap.Modal("#staticBackdrop", {});
export function find_get_parameter(parameter_name) {
  var result = null,
      tmp = [];
  location.search
      .substr(1)
      .split("&")
      .forEach(function (item) {
        tmp = item.split("=");
        if (tmp[0] === parameter_name) result = decodeURIComponent(tmp[1]);
      });
  return result;
}

console.log(show_modal);
if (show_modal)
    modal.show();