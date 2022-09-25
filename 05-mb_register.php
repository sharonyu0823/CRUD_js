<?php
$pageName = 'mb_register';
?>

<?php include __DIR__ . '/parts/html-head.php'; ?>
<?php include __DIR__ . '/parts/05-nav-bar-no-admin.php'; ?>

<style>
    .error_input {
        border: 3px solid red;
    }
</style>

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
                            <input type="text" class="form-control" name="mbrSurname" id="mbrSurname" onblur="checkSurname();">
                            <div style="color: red;" id="mbrSurname_error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="mbrForename" class="form-label">名字</label>
                            <input type="text" class="form-control" name="mbrForename" id="mbrForename" onblur="checkForename();">
                            <div style="color: red;" id="mbrForename_error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="mbrNickname" class="form-label">暱稱</label>
                            <input type="text" class="form-control" name="mbrNickname" id="mbrNickname" onblur="checkNickname();">
                            <div style="color: red;" id="mbrNickname_error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="mbrAccount" class="form-label">註冊信箱</label>
                            <input type="email" class="form-control" name="mbrAccount" id="mbrAccount" onblur="checkEmail();">
                            <div style="color: red;" id="mbrAccount_error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="mbrPassword1" class="form-label">註冊密碼</label>
                            <input type="text" class="form-control " name="mbrPassword1" id="mbrPassword1" placeholder="請設定8位英數特殊字元混合密碼，英文需區分大小寫" onblur="checkPassword1();">
                            <div style="color: red;" id="mbrPassword1_error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="mbrPassword2" class="form-label">密碼確認</label>
                            <input type="text" class="form-control " name="mbrPassword2" id="mbrPassword2" placeholder="請再輸入一次密碼" onblur="checkPassword2();">
                            <div style="color: red;" id="mbrPassword2_error"></div>
                        </div>
                        <div class="mb-4 form-check">
                            <input type="checkbox" class="form-check-input" name="mbrCheck" id="mbrCheck" value="1" onchange="checkCheck();">
                            <label class="form-check-label" for="mbrCheck">我同意 <a id="FoodAgree" href="https://drive.google.com/file/d/1RCTH1c06K3D6d6oLE1DIUzG-2ONVitzX/view" target="_blank">惜食戰士條款</a></label>
                            <div style="color: red;" id="mbrCheck_error"></div>
                        </div>
                        <button type="submit" class="btn btn-primary" id="mbr_button">立即註冊</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /* <div class="modal" id="myModal" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" id="modal_header">Modal Heading</h4>
            </div>

            <!-- Modal body -->
            <div class="modal-body" id="modal_body">
                Modal body..
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="modal_footer">Close</button>
            </div>

        </div>
    </div>
</div> */ ?>


<!-- reference: https://www.momoshop.com.tw/customer/CustomerInput.jsp -->


<?php include __DIR__ . '/parts/scripts.php'; ?>

<script src="05-mb_register_valid.js"></script>
<script>
    // 驗證姓名

    function checkSurname() {
        const inpSurname = document.querySelector('#mbrSurname');
        let Surname = inpSurname.value;

        const mbrSurname_error = document.querySelector('#mbrSurname_error');

        if (checkEmpty(Surname)) {
            inpSurname.classList.remove("is-invalid");
            inpSurname.classList.add("is-valid");
            mbrSurname_error.innerHTML = '';
            return true;
        } else {
            // mbrSurname-error
            inpSurname.classList.add("is-invalid");
            mbrSurname_error.innerHTML = '請輸入姓氏';
            return false;
        }
    }

    // 驗證名字

    function checkForename() {
        const inpForename = document.querySelector('#mbrForename');
        let Forename = inpForename.value;

        const mbrForename_error = document.querySelector('#mbrForename_error');

        if (checkEmpty(Forename)) {
            inpForename.classList.remove("is-invalid");
            inpForename.classList.add("is-valid");
            mbrForename_error.innerHTML = '';
            return true;
        } else {
            inpForename.classList.add("is-invalid");
            mbrForename_error.innerHTML = '請輸入名字';
            return false;
        }
    };

    // 驗證暱稱
    function checkNickname() {
        const inpNickname = document.querySelector('#mbrNickname');
        inpNickname.classList.add("is-valid");
    }


    // 驗證信箱
    function checkEmail() {
        const inpAccount = document.querySelector('#mbrAccount');
        let Account = inpAccount.value;

        const mbrAccount_error = document.querySelector('#mbrAccount_error');

        // - 驗證空白
        if (checkEmpty(Account)) {

            // - 驗證規格
            const checkError = checkAccount(Account);
            mbrAccount_error.innerHTML = checkError;

            if (checkError === "") {
                inpAccount.classList.remove("is-invalid");
                inpAccount.classList.add("is-valid");
                return true;
            } else {
                inpAccount.classList.add("is-invalid");
                return false;
            }

        } else {
            mbrAccount_error.innerHTML = '請輸入註冊信箱';
            inpAccount.classList.add("is-invalid");
            return false;
        }
    }

    // 驗證密碼

    function checkPassword1() {
        const inpPassword1 = document.querySelector('#mbrPassword1');
        let Password1 = inpPassword1.value;

        const inpPassword1_error = document.querySelector('#mbrPassword1_error');

        const p1Error = checkPassword(Password1);
        inpPassword1_error.innerHTML = p1Error;

        if (p1Error === '') {
            inpPassword1.classList.remove("is-invalid");
            inpPassword1.classList.add("is-valid");
            return true;
        } else {
            inpPassword1.classList.add("is-invalid");
            return false;
        }
    }

    // 驗證密碼確認

    function checkPassword2() {
        const inpPassword1 = document.querySelector('#mbrPassword1');
        let Password1 = inpPassword1.value;

        const inpPassword2 = document.querySelector('#mbrPassword2');
        let Password2 = inpPassword2.value;

        const inpPassword2_error = document.querySelector('#mbrPassword2_error');

        // - 驗證空白
        if (checkEmpty(Password2)) {

            // - 驗證規格
            const p2Error = check2Password(Password1, Password2);
            inpPassword2_error.innerHTML = p2Error;

            if (p2Error === '') {
                inpPassword2.classList.remove("is-invalid");
                inpPassword2.classList.add("is-valid");
                return true;
            } else {
                inpPassword2.classList.add("is-invalid");
                return false;
            }

        } else {
            inpPassword2_error.innerHTML = '請輸入密碼';
            inpPassword2.classList.add("is-invalid");
            return false;
        }
    }

    // 驗證我同意

    function checkCheck() {
        const inpCheck = document.querySelector('#mbrCheck');
        let Check = inpCheck.checked;
        // console.log(Check); // 1
        // console.log(inpCheck.checked) // true or false

        const mbrCheck_error = document.querySelector('#mbrCheck_error');
        const FoodAgree = document.querySelector('#FoodAgree');

        if (Check) {
            inpCheck.classList.remove("is-invalid");
            inpCheck.classList.add("is-valid");
            FoodAgree.style.color = "green";
            mbrCheck_error.innerHTML = '';
            return true;
        } else {
            // alert('請點選我同意');
            inpCheck.classList.add("is-invalid");
            FoodAgree.style.color = "red";
            mbrCheck_error.innerHTML = '你必須同意才可送出';
            return false;
        }
    }

    function checkForm() {
        const myModalLS = new bootstrap.Modal(document.getElementById('myModalSuccess'), {
            keyboard: false
        });

        const a = checkSurname();
        const b = checkForename();
        const c = checkEmail();
        const d = checkPassword1();
        const e = checkPassword2();
        const f = checkCheck();

        if (a && b && c && d && e && f) {
            const fd_r = new FormData(document.mbRegistForm);

            // fetch api

            fetch('05-mb_register_api.php', {
                    method: 'POST',
                    body: fd_r,
                })
                .then(r => r.json())
                .then(obj => {
                    console.log(obj);
                    if (!obj.success) {
                        // alert(obj.error); // 後端的錯誤

                        myModal.show();
                        document.querySelector('#modal_header_s').innerHTML = '註冊';
                        document.querySelector('#modal_body_s').innerHTML = obj.error;

                    } else {
                        myModalLS.show();
                        document.querySelector('#modal_header_s').innerHTML = '註冊';
                        document.querySelector('#modal_body_s').innerHTML = '註冊成功';
                        document.querySelector('#modal_footer_s').addEventListener('click', () => {
                            location.href = '05-basepage-no-admin.php';
                        })

                        // alert('新增成功');
                        // location.href = '05-basepage-no-admin.php';
                    }
                })
        }
    }

    // 迴圈寫法 但比較不建議 因為維護較難
    // for (const pair of fd_r.entries()) {
    //     console.log(`${pair[0]}, ${pair[1]}`);
    // }

    // for (let k of fd_r.keys()) {
    //     console.log(`${k}: ${fd_r.get(k)}`);
    //     checkEmpty(fd_r.get(k))
    // }

    // https://developer.mozilla.org/en-US/docs/Web/API/FormData/entries
</script>

<?php include __DIR__ . '/parts/html-foot.php'; ?>