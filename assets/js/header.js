// Khai báo biến
let navbar = document.querySelector(".navbar");
let navbarMenu = document.querySelector(".navbar-menu");
let navbarDisplayUser = document.querySelector(".navbar-display-user");
let navbarToggle = document.querySelector(".navbar-toggle");
let navbarClose = document.querySelector(".navbar-close");

let floatingAction = document.querySelector(".floating-action");
let actionHome = document.querySelector(".action-home");
let actionMenu = document.querySelector(".action-menu");
let actionTop = document.querySelector(".action-top");
let actionUser = document.querySelector(".action-user");

let actionToggle = document.querySelector(".action-toggle");
let userAction = document.querySelector(".navbar-display-action");

let searchInput = document.querySelector("#search-box");
let searchIcon = document.querySelector(".navbar-search .icon");

// Hàm kiểm tra và kích hoạt nút floating action
function activeFloatingAction() {
  if (window.pageYOffset > 5) {
    floatingAction.classList.remove("hidden");
  } else {
    floatingAction.classList.add("hidden");
  }
}

// Hàm kích hoạt menu người dùng
function activeUserAction() {
  navbar.classList.remove("active-menu"),
    navbar.classList.add("active-user-menu"),
    floatingAction.classList.remove("activated"),
    (actionToggle.innerHTML = '<i class="bx bx-target-lock"></i>');
}

// Hàm kích hoạt menu danh sách
function activeMenu() {
  navbar.classList.add("active-menu"),
    navbar.classList.remove("active-user-menu"),
    floatingAction.classList.remove("activated"),
    (actionToggle.innerHTML = '<i class="bx bx-target-lock"></i>');
}

// Hàm cuộn trang
function scrollTo(target, end, duration) {
  if (!(duration <= 0)) {
    let offset = ((end - target.scrollTop) / duration) * 10;
    setTimeout(function () {
      target.scrollTop = target.scrollTop + offset;
      target.scrollTop !== end && scrollTo(target, end, duration - 10);
    }, 10);
  }
}

// Hàm cuộn trang toàn bộ
function scrollPageTo(target, duration) {
  try {
    return void (document.body.scrollTop > 0
      ? scrollTo(document.body, target, duration)
      : scrollTo(document.documentElement, target, duration));
  } catch (error) {}
  window.scrollTo(0, target);
}

// Hàm tìm kiếm
function search() {
  searchInput.value.length &&
    (window.location.href = "index.php?pages=truyen-tim-kiem&tu-khoa=" + slugify(searchInput.value));
}

// Hàm chuyển đổi chuỗi thành dạng slug
function slugify(str) {
  let slug = str.toString().toLowerCase();
  // Chuyển đổi ký tự có dấu thành không dấu
  slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, "a");
  slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, "e");
  slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, "i");
  slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, "o");
  slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, "u");
  slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, "y");
  slug = slug.replace(/đ/gi, "d");

  // Xóa các ký tự đặc biệt
  slug = slug.replace(
    /\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi,
    ""
  );

  // Đổi khoảng trắng thành ký tự gạch ngang
  slug = slug.replace(/ /gi, " - ");

  // Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
  slug = slug.replace(/\-\-\-\-\-/gi, "-");
  slug = slug.replace(/\-\-\-\-/gi, "-");
  slug = slug.replace(/\-\-\-/gi, "-");
  slug = slug.replace(/\-\-/gi, "-");

  // Xóa các ký tự gạch ngang ở đầu và cuối
  slug = "@" + slug + "@";
  slug = slug.replace(/\@\-|\-\@|\@/gi, "");
  return slug;
}

// Bắt sự kiện click vào nút toggle
navbarToggle.onclick = function () {
  navbar.classList.add("active-menu");
};

// Bắt sự kiện click vào nút close
navbarClose.onclick = function () {
  navbar.classList.remove("active-menu");
};

// Bắt sự kiện click vào nút toggle action
actionToggle.onclick = function () {
  floatingAction.classList.contains("activated")
    ? (floatingAction.classList.remove("activated"),
      (this.innerHTML = '<i class="bx bx-target-lock"></i>'))
    : (floatingAction.classList.add("activated"),
      (this.innerHTML = '<i class="bx bx-x"></i>'));
};

// Bắt sự kiện click vào nút home
actionHome.onclick = function () {
  window.location.href = "./index.php";
};

// Bắt sự kiện click vào display-user người dùng
navbarDisplayUser.onclick = function () {
  activeUserAction(), userAction.classList.toggle("hidden");
};

// Bắt sự kiện click vào nút menu
actionMenu.onclick = function () {
  activeMenu();
};

// Bắt sự kiện click vào nút người dùng
actionUser.onclick = function () {
  activeUserAction(), userAction.classList.remove("hidden");
};

// Bắt sự kiện click vào nút lên đầu trang
actionTop.onclick = function () {
  scrollPageTo(0, 600);
};

// Bắt sự kiện nhấn phím Enter khi đang nhập vào ô tìm kiếm
searchInput.onkeydown = function (event) {
  if (event.which === 13) search();
};

// Bắt sự kiện click vào biểu tượng tìm kiếm
searchIcon.onclick = function () {
  search();
};

// Bắt sự kiện cuộn trang
window.addEventListener("scroll", activeFloatingAction);

// Bắt sự kiện click bên ngoài để đóng menu người dùng
window.addEventListener("click", function (event) {
  if (
    !navbarDisplayUser.contains(event.target) &&
    !userAction.contains(event.target) &&
    !actionUser.contains(event.target)
  ) {
    userAction.classList.add("hidden");
    navbar.classList.remove("active-user-menu");
  }
});

// Bắt sự kiện click bên ngoài để đóng menu danh sách
window.addEventListener("click", function (event) {
  if (
    !navbarToggle.contains(event.target) &&
    !navbarMenu.contains(event.target) &&
    !actionMenu.contains(event.target)
  ) {
    navbar.classList.remove("active-menu");
  }
});
