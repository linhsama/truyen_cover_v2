function likeTruyen(truyen_id, chapter_id) {
  // Gửi yêu cầu AJAX để tăng số lượt thích
  $.ajax({
    type: "POST",
    url: "components/action.php", // Điều này cần phải chỉ đến một file xử lý AJAX trên máy chủ 
    data: { action: "like", truyen_id: truyen_id, chapter_id: chapter_id },
    success: function (response) {
      // Cập nhật số lượt theo dõi trên giao diện
      if (response == "login_required") {
        const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 2000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
          },
        });
        Toast.fire({
          icon: "info",
          title: "Vui lòng đăng nhập!",
        });
      } else {
        $("#thich-count").text(response);
        const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 2000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
          },
        });
        Toast.fire({
          icon: "success",
          title: "Đã theo thích truyện!",
        });
      }
    },
  });
}

function followTruyen(truyen_id, chapter_id) {
  // Gửi yêu cầu AJAX để tăng số lượt theo dõi
  $.ajax({
    type: "POST",
    url: "components/action.php", // Điều này cần phải chỉ đến một file xử lý AJAX trên máy chủ 
    data: { action: "follow", truyen_id: truyen_id, chapter_id: chapter_id },
    success: function (response) {
      // Cập nhật số lượt theo dõi trên giao diện
      if (response == "login_required") {
        const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 2000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
          },
        });
        Toast.fire({
          icon: "info",
          title: "Vui lòng đăng nhập!",
        });
      } else {
        $("#theo-doi-count").text(response);
        const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 2000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
          },
        });
        Toast.fire({
          icon: "success",
          title: "Đã theo dõi truyện!",
        });
      }
    },
  });
}

function viewTruyen(truyen_id, chapter_id) {
  $.ajax({
    type: "POST",
    url: "components/action.php",
    data: { action: "view", truyen_id: truyen_id, chapter_id: chapter_id },
    success: function (response) {
      $("#view-count").text(response);
    },
  });
}

