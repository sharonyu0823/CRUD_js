// 驗證空值

function checkEmpty(item) {
    let data = item.trim();
    let isValid = true;

    if (data === "" || data.length === 0) {
        isValid = false;
    }

    return isValid;
}

// 帳號和密碼不能有空白 valid._test4.html (備著)

function checkWhitespace(whiteAccount) {
    let isValid = true;

    if (whiteAccount.search(/\s/g) !== -1)

        return isValid;
}

// 驗證帳號規格 valid._test2.html

function checkAccount(inpAccount) {

    if (inpAccount.search(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z]+$/) != -1) {
        return "";
    } else {
        return "帳號規格不正確";
    }

    return isValid;
}
// reference: https://blog.xuite.net/david670919/twblog/h.j44bocmmaeu1#

// 驗證密碼規格 valid._test1.html

function checkPassword(inpPassword) {
    const trimPassword = inpPassword.trim();
    if (trimPassword === "" || trimPassword.length === 0) {
        return "密碼不能為空白";
    } else if (trimPassword.length <= 7) {
        return "密碼最少8個字元";
    } else if (!/[A-Z]/.test(trimPassword)) {
        return "密碼需要有大寫英文字母";
    } else if (!/[A-Z]/.test(trimPassword)) {
        return "密碼需要有小寫英文字母";
    } else if (!/\d/.test(trimPassword)) {
        return "密碼至少要有一個數字";
    } else if (!/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/.test(trimPassword)) {
        return "密碼至少要有一個特殊字元";
    } else if (trimPassword.search(/[\s]/g) !== -1) {
        return "密碼不能有空白字元";
    } else {
        return "";
    }
}

// 密碼二次確認與第一次輸入的密碼是否一樣 valid._test3.html

function check2Password(inpPassword1, inpPassword2) {

    if (inpPassword1 === inpPassword2) {
        return "";
    } else {
        return "密碼不同";
    };
}

