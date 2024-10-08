
<style>
    .button {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color: rgb(20, 20, 20);
        border: none;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0px 0px 0px 4px rgba(180, 160, 255, 0.253);
        cursor: pointer;
        transition-duration: 0.3s;
        overflow: hidden;
        position: fixed;
        /* Đảm bảo nút cố định ở góc dưới trang */
        bottom: 20px;
        right: 20px;
        display: none;
        /* Ban đầu ẩn đi */
        z-index: 9999;
    }

    .svgIcon {
        width: 24px;
        transition-duration: 0.3s;
    }

    .svgIcon path {
        fill: white;
    }

    .button:hover {
        width: 140px;
        border-radius: 50px;
        transition-duration: 0.3s;
        background-color: rgb(38, 221, 218);
        align-items: center;
    }

    .button:hover .svgIcon {
        transition-duration: 0.3s;
        transform: translateY(-200%);
    }

    .button::before {
        position: absolute;
        bottom: -20px;
        content: "Back to Top";
        color: white;
        font-size: 0px;
    }

    .button:hover::before {
        font-size: 13px;
        opacity: 1;
        bottom: unset;
        transition-duration: 0.3s;
    }
</style>

<div>
    <button id="scrollToTopBtn" class="button">
        <svg class="svgIcon" viewBox="0 0 384 512" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M214.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 141.2V448c0 17.7 14.3 32 32 32s32-14.3 32-32V141.2L329.4 246.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-160-160z" />
        </svg>
    </button>

    <script>
        // Kiểm tra sự kiện khi cuộn trang
        window.onscroll = function() {
            scrollFunction();
        };

        function scrollFunction() {
            var scrollToTopBtn = document.getElementById("scrollToTopBtn");
            // Nếu cuộn trang xuống quá 300px thì hiển thị nút
            if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
                scrollToTopBtn.style.display = "flex"; // Sử dụng 'flex' để nút hiển thị đúng cách
            } else {
                scrollToTopBtn.style.display = "none";
            }
        }

        // Khi nhấn vào nút, cuộn lên đầu trang trong 2 giây
        document.getElementById("scrollToTopBtn").addEventListener("click", function() {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        });
    </script>
</div>
