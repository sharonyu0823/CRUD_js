<?php
$pageName = 'mb_register';
?>

<?php include __DIR__ . '/parts/html-head.php'; ?>
<?php include __DIR__ . '/parts/nav-bar-no-admin.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-lg-6 mx-auto">
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
                            <label for="mbrPassword1" class="form-label">註冊密碼</label>
                            <input type="text" class="form-control" name="mbrPassword1" id="mbrPassword1" placeholder="請設定8位英數特殊字元混合密碼，英文需區分大小寫">
                        </div>
                        <div class="mb-3">
                            <label for="mbrPassword2" class="form-label">密碼確認</label>
                            <input type="text" class="form-control" name="mbrPassword2" id="mbrPassword2" placeholder="請再輸入一次密碼">
                        </div>
                        <div class="mb-4 form-check">
                            <input type="checkbox" class="form-check-input" name="mbrCheck" id="mbrCheck" value="1">
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

<script src="mb_register_valid.js"></script>
<script>
    function checkForm() {




        // TODO: 檢查欄位資料
        let isValid = true;

        // if(checkEmpty(item) == true) {
        //     console.log("密碼不能為空白");
        // } else if (){

        // } else if (){

        // } else if (){

        // }

        // 驗證密碼規格
        const inpPassword = document.querySelector('#mbrPassword');

        const Password = inpPassword.value;

        if (checkPassword(Password)) {
            alert(`Password ${Password}`)
        } else {
            alert('請輸入密碼');
        }


        // fetch api
        const fd_r = new FormData(document.mbRegistForm);
        for (const pair of fd_r.entries()) {
            console.log(`${pair[0]}, ${pair[1]}`);
        }

        for (let k of fd_r.keys()) {
            console.log(`${k}: ${fd_r.get(k)}`);
            checkEmpty(fd_r.get(k))
        }

        // https://developer.mozilla.org/en-US/docs/Web/API/FormData/entries

        // fetch('mb_register_api.php', {
        //         method: 'POST',
        //         body: fd_r,
        //     })
        //     .then(r => r.json())
        //     .then(obj => {
        //         console.log(obj);
        //         if (!obj.success) {
        //             alert(obj.error);
        //         } else {
        //             alert('新增成功');
        //             location.href = 'basepage-no-admin.php';
        //         }
        //     })

    }
</script>

<?php include __DIR__ . '/parts/html-foot.php'; ?>