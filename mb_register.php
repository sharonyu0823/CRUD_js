<?php include __DIR__ . '/parts/html-head.php'; ?>
<?php include __DIR__ . '/parts/nav-bar_SY.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4 fw-bolder">填寫註冊資料</h5>

                    <!-- 表單填寫 -->
                    <form name="mbRegistForm" onsubmit="checkForm(); return false;" novalidate>
                        <div class="mb-3">
                            <label for="mbrSurname" class="form-label">姓氏</label>
                            <input type="text" class="form-control" name="mbrSurname" id="mbrSurname">
                        </div>
                        <div class="mb-3">
                            <label for="mbrForename" class="form-label">名字</label>
                            <input type="text" class="form-control" name="mbrForename" id="mbrForename">
                        </div>
                        <div class="mb-3">
                            <label for="mbrNickname" class="form-label">暱稱</label>
                            <input type="text" class="form-control" name="mbrNickname" id="mbrNickname">
                        </div>
                        <div class="mb-3">
                            <label for="mbrAccount" class="form-label">註冊信箱</label>
                            <input type="email" class="form-control" name="mbrAccount" id="mbrAccount">
                        </div>
                        <div class="mb-3">
                            <label for="mbrPassword" class="form-label">註冊密碼</label>
                            <input type="text" class="form-control" name="mbrPassword" id="mbrPassword" placeholder="請設定8位英數特殊字元混合密碼，英文需區分大小寫">
                        </div>
                        <div class="mb-3">
                            <label for="mbrPassword" class="form-label">密碼確認</label>
                            <input type="text" class="form-control" name="mbrPassword" id="mbrPassword" placeholder="請再輸入一次密碼">
                        </div>
                        <div class="mb-4 form-check">
                            <input type="checkbox" class="form-check-input" name="mbrCheck" id="mbrCheck">
                            <label class="form-check-label" for="mbrCheck">我同意 <a href="https://drive.google.com/file/d/1RCTH1c06K3D6d6oLE1DIUzG-2ONVitzX/view" target="_blank">惜食戰士條款</a></label>
                        </div>
                        <button type="submit" class="btn btn-primary" id="mbr_button">立即註冊</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- reference: https://www.momoshop.com.tw/customer/CustomerInput.jsp -->


<?php include __DIR__ . '/parts/scripts.php'; ?>

<script>
    function checkForm() {
        const fd_r = new FormData(document.mbRegistForm);
        // 驗證空值


        // 驗證帳號

        // 驗證密碼
        // const inpPassword = document.querySelector('#mbrPassword');

        // const Password = inpPassword.value;

        // if (checkPassword(Password)) {
        //     alert(`Password ${Password}`)
        // } else {
        //     alert('請輸入密碼');
        // }

        // 密碼確認

        // fetch api
        fetch('mb_register_api.php', {
                method: 'POST',
                body: fd_r,
            })
            .then(r => r.json())
            .then(obj_r => {
                console.log(obj_r);
            })

    }

    // function checkPassword(inpPassword) {
    //     const trimPassword = inpPassword.trim();
    //     let isValid = true;
    //     if (trimPassword === "" || trimPassword.length === 0) {
    //         isValid = false;
    //         console.log("密碼不能為空白");
    //     } else if (trimPassword.length <= 7) {
    //         isValid = false;
    //         console.log("密碼最少8個字元");
    //     } else if (!/[A-Z]/.test(trimPassword)) {
    //         isValid = false;
    //         console.log("密碼需要有大寫英文字母");
    //     } else if (!/[A-Z]/.test(trimPassword)) {
    //         isValid = false;
    //         console.log("密碼需要有小寫英文字母");
    //     } else if (!/\d/.test(trimPassword)) {
    //         isValid = false;
    //         console.log("密碼至少要有一個數字");
    //     } else if (!/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/.test(trimPassword)) {
    //         isValid = false;
    //         console.log("密碼至少要有一個特殊字元");
    //     }

    //     return isValid;

    // }
</script>

<?php include __DIR__ . '/parts/html-foot.php'; ?>