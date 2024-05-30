
// Password_view_&_hide_(login_resgister)
function viweps() {
    var ps = document.getElementById("password");
    var icon = document.getElementById("eye");

    if (ps.type == "password") {
        ps.type = "text";
        icon.innerHTML = '<i class="bi bi-eye-fill"></i>';

    } else {
        ps.type = "password";
        icon.innerHTML = '<i class="bi bi-eye-slash-fill"></i>';
    }
}

//frogot_password_newps_viwe
function viwefps() {
    var ps = document.getElementById("np");
    var icon = document.getElementById("eye");

    if (ps.type == "password") {
        ps.type = "text";
        icon.innerHTML = '<i class="bi bi-eye-fill"></i>';

    } else {
        ps.type = "password";
        icon.innerHTML = '<i class="bi bi-eye-slash-fill"></i>';
    }
}

//frogot_password_renewps_viwe
function viwefrps() {
    var ps = document.getElementById("rnp");
    var icon = document.getElementById("reye");

    if (ps.type == "password") {
        ps.type = "text";
        icon.innerHTML = '<i class="bi bi-eye-fill"></i>';

    } else {
        ps.type = "password";
        icon.innerHTML = '<i class="bi bi-eye-slash-fill"></i>';
    }
}

// Register_page_date_sending_
function Register() {

    var fn = document.getElementById("fname");
    var ln = document.getElementById("lname");
    var e = document.getElementById("email");
    var p = document.getElementById("password");
    var m = document.getElementById("mobile");


    var f = new FormData();
    f.append("fname", fn.value);
    f.append("lname", ln.value);
    f.append("email", e.value);
    f.append("password", p.value);
    f.append("mobile", m.value);


    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {

        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t == "good") {

                document.getElementById("msgdiv").className = "d-block";
                document.getElementById("msg").className = "alert alert-success";
                document.getElementById("msg").innerHTML = "Your account has been created, Now you can log in";


            }

            if (t == "bad") {

                document.getElementById("msgdiv").className = "d-block";
                document.getElementById("msg").innerHTML = "your email or Phone Number has already existed";


            }

            if (t !== "bad" && t !== "good") {
                document.getElementById("msgdiv").className = "d-block";
                document.getElementById("msg").innerHTML = t;

            }

        }
    }
    r.open("POST", "registerProcess.php", true);
    r.send(f);
}
// Log_page_date_sending_
function login() {
    var email = document.getElementById("email");
    var ps = document.getElementById("password");
    var rm = document.getElementById("rememberme");

    var f = new FormData();
    f.append("email", email.value);
    f.append("password", ps.value);
    f.append("rememberme", rm.checked);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;

            if (t == "costomer") {

                window.location = "index.php";

            } else if (t == "admin") {

                window.location = "admin_log.php";

            } else {
                document.getElementById("msgdiv").className = "d-block";
                document.getElementById("msg").innerHTML = t;
            }


        }
    }

    r.open("POST", "log_in_process.php", true);
    r.send(f);

}

// get VC for Reset Password
function vcode() {

    var email = document.getElementById("email").value;

    document.getElementById("vc").className = "d-none";
    document.getElementById("msg").innerHTML = "Processing";
    document.getElementById("msg").className = " alert alert-success";
    document.getElementById("msgdiv").className = "d-block";
    document.getElementById("sbtn").className = "d-none";

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;

            if (t == "Good") {

                document.getElementById("msg").innerHTML = "Verification Code Sent";
                document.getElementById("sbtn").className = "d-block btn btn-success col-12 text-center fw-bold";



            } if (t !== "Good") {

                document.getElementById("msg").innerHTML = t;
                document.getElementById("msg").className = "alert alert-danger";
                document.getElementById("msgdiv").className = "col-12 d-block";
                document.getElementById("vc").className = "d-block";
                document.getElementById("vc").className = " btn btn-success col-12 text-center fw-bold ";
                document.getElementById("sbtn").className = "d-block btn btn-success col-12 text-center fw-bold";
            }

        }
    }

    r.open("GET", "forgetpasswordprocess.php?e=" + email, true);
    r.send();

}

// reset Password
function resetPs() {

    var email = document.getElementById("email");
    var new_ps = document.getElementById("np");
    var re_ps = document.getElementById("rnp");
    var vcode = document.getElementById("vcode");

    var f = new FormData();
    f.append("email", email.value);
    f.append("np", new_ps.value);
    f.append("rnp", re_ps.value);
    f.append("vcode", vcode.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;

            if (t === "Success") {
                document.getElementById("msgdiv").className = "d-block";
                document.getElementById("msg").className = "alert alert-success";
                document.getElementById("msg").innerHTML = "password changed";

                setInterval(function () {
                }, 200);

                // Set a 5-second countdown
                var countdown = 5; // 5 seconds
                var countdownInterval = setInterval(function () {

                    document.getElementById("msg").innerHTML = "Redirecting to Log-in in " + countdown + " seconds";

                    if (countdown <= 0) {
                        clearInterval(countdownInterval);
                        window.location = "Log_in.php";
                    } else {
                        countdown--;
                    }
                }, 1000);

            } else {
                document.getElementById("msgdiv").className = "d-block";
                document.getElementById("msg").className = "alert alert-danger";
                document.getElementById("msg").innerHTML = t;
            }


        }
    }

    r.open("POST", "resetpaaswordProcess.php", true);
    r.send(f);

}

// user log out
function logout() {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {

        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;

            if (t == "done") {

                window.location.reload();
                // window.location= "Log_in.php.";

            } else {

                alert(t);
                window.location.reload();

            }
        }
    }

    r.open("GET", "logoutprocess.php", true);
    r.send();
}

//admin log out
function alogout() {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {

        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;

            if (t == "done") {

                // window.location.reload();
                window.location = "Log_in.php.";

            } else {

                alert(t);
                window.location.reload();

            }
        }
    }

    r.open("GET", "logoutprocess.php", true);
    r.send();
}

function login_admin() {

    var admin = document.getElementById("admin");
    var ps = document.getElementById("password");

    var f = new FormData();
    f.append("admin", admin.value);
    f.append("password", ps.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;

            if (t == 'ok') {
                window.location = "control_panel.php";
            } else {
                document.getElementById("msgdiv").className = "d-block";
                document.getElementById("msg").innerHTML = t;
            }


        }
    }

    r.open("POST", "admin_log_process.php", true);
    r.send(f);

}

function basicsearch(x) {
    var text = document.getElementById("text");
    var cat = document.getElementById("cat");

    var f = new FormData();
    f.append("text", text.value);
    f.append("cat", cat.value);
    f.append("page", x);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            if (t != 'doNothing') {
                document.getElementById("basicSearchResult").innerHTML = t;
            }

        }
    }

    r.open("POST", "basicsearchprocess.php", true);
    r.send(f);

}

function qty_inc(qty) {

    var input = document.getElementById("qty_play");
    if (qty > input.value) {

        var new_value = parseInt(input.value) + 1;
        input.value = new_value;

    } else {

        alert("You have reched to the Maximum");
        input.value = qty;
    }


}

function qty_dec() {

    var input = document.getElementById("qty_play");

    if (1 < input.value) {

        var new_value = parseInt(input.value) - 1;
        input.value = new_value;

    } else {

        alert("You have reched to the Minimum");
        input.value = 1;
    }


}

function copyImage(im) {
    var imge = document.getElementById(im);
    var mainImg = document.getElementById('mainImg');

    // Copy the src of the clicked image to the main image
    mainImg.src = imge.src;
}

function saveInvoice(orderId) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "A") {

                window.location = "invoice.php?id=" + orderId;

            } else {

                alert(t);
            }
        }
    }

    r.open("GET", "saveInvoice.php?order_id=" + orderId, true);
    r.send();

}

function updateprofile() {

    var uimg = document.getElementById("uimg");
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var email = document.getElementById("email");
    var phone = document.getElementById("phone");
    var pw = document.getElementById("password");
    var line1 = document.getElementById("line1");
    var line2 = document.getElementById("line2");
    var province = document.getElementById("province");
    var district = document.getElementById("district");
    var city = document.getElementById("city");
    var pcode = document.getElementById("pcode");

    var f = new FormData();
    f.append("pm", uimg.files[0]);
    f.append("fname", fname.value);
    f.append("lname", lname.value);
    f.append("email", email.value);
    f.append("phone", phone.value);
    f.append("password", pw.value);
    f.append("line1", line1.value);
    f.append("line2", line2.value);
    f.append("province", province.value);
    f.append("district", district.value);
    f.append("city", city.value);
    f.append("pcode", pcode.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            if (t == 'Done') {
                logout();
                alert("Profile Has Updated");

            } else {
                alert(t);
            }
        }

    }

    r.open("POST", "updateProfileProcess.php", true);
    r.send(f);

}
function changeProfilemage() {

    var images = document.getElementById("uimg");

    images.onchange = function () {
        var file_count = images.files.length;

        if (file_count == 1) {

            var fils = this.files[0];
            var url = window.URL.createObjectURL(fils);
            document.getElementById("i").src = url;

        } else {
            alert(file_count + " files uploaded. you are Proceed to upload one Image")
        }
    }

}

function loaddistric() {
    var province = document.getElementById("province").value;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;

            document.getElementById("district").innerHTML = t;
        }

    }

    r.open("GET", "loaddistric.php?p=" + province, true);
    r.send();

}

function loadcity() {

    var city = document.getElementById("district").value;


    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;

            document.getElementById("city").innerHTML = t;
        }

    }

    r.open("GET", "loadcity.php?c=" + city, true);
    r.send();

}

function newps() {

    var email = document.getElementById("email");
    var new_ps = document.getElementById("np");
    var re_ps = document.getElementById("rnp");
    var vcode = document.getElementById("vcode");

    var f = new FormData();
    f.append("email", email.value);
    f.append("np", new_ps.value);
    f.append("rnp", re_ps.value);
    f.append("vcode", vcode.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;

            if (t == "Success") {

                alert("Password has Updated");
                window.location = "Log_in.php";

            } else {
                document.getElementById("msgdiv").className = "d-block";
                document.getElementById("msg").innerHTML = t;
            }


        }
    }

    r.open("POST", "resetpaaswordProcess.php", true);
    r.send(f);

}

function addproduct() {

    var pname = document.getElementById("pname");
    var price = document.getElementById("price");
    var qty = document.getElementById("qty");
    var dfree = document.getElementById("dfee");
    var category = document.getElementById("pcat");
    var desc = document.getElementById("desc");
    var pimg = document.getElementById("pimg");

    var f = new FormData();
    f.append("pname", pname.value);
    f.append("price", price.value);
    f.append("qty", qty.value);
    f.append("dfee", dfree.value);
    f.append("cat", category.value);
    f.append("des", desc.value);

    var file_count = pimg.files.length;

    for (var x = 0; x < file_count; x++) {
        f.append("pim" + x, pimg.files[x]);
    }

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;

            if (t == 'sucsess') {
                alert("Product Added Successfully.");
                window.location = "myproduct.php";

            } else {

                alert(t);

            }

        }
    }

    r.open("POST", "addProductProcess.php", true);
    r.send(f);
}

function changeProductImage() {
    var images = document.getElementById("pimg");

    images.onchange = function () {
        var file_count = images.files.length;

        if (file_count <= 3) {

            for (var x = 0; x < file_count; x++) {

                var file = this.files[x];
                var url = window.URL.createObjectURL(file);
                document.getElementById("i" + x).src = url;
            }

        } else {
            alert(file_count + " files. You are proceed to upload only 3 or less than 3 files.")
        }
    }
}

function changeStatus(id) {
    var product_id = id;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            if (t == "ok") {
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "changestatusprocess.php?p=" + product_id, true);
    r.send();
}

function sendId(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                window.location = "updateProduct.php";
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "sendidprocess.php?id=" + id, true);
    r.send();

}

function updateproduct() {

    var pname = document.getElementById("pname");
    var qty = document.getElementById("qty");
    var dfree = document.getElementById("dfee");
    var desc = document.getElementById("desc");
    var pimg = document.getElementById("pimg");

    var f = new FormData();
    f.append("pname", pname.value);
    f.append("qty", qty.value);
    f.append("dfee", dfree.value);
    f.append("des", desc.value);

    var file_count = pimg.files.length;

    for (var x = 0; x < file_count; x++) {
        f.append("pim" + x, pimg.files[x]);
    }

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;

            if (t == 12) {
                alert("Product Update Sucsess");
                window.location = "myproduct.php";

            } else if (t == 2) {
                alert("Product Date Update Sucsess");
                alert("Product Image has not Updated");
                window.location = "myproduct.php";

            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "updateProductProcess.php", true);
    r.send(f);
}

function deleteProduct(id) {

    if (confirm("Do You Want to Delete This Product") == true) {
        var r = new XMLHttpRequest();

        r.onreadystatechange = function () {
            if (r.status == 200 && r.readyState == 4) {
                var t = r.responseText;
                if (t == 1) {
                    window.location.reload();
                } else {
                    alert(t);
                }
            }
        }

        r.open("GET", "deleteProductProcess.php?id=" + id, true);
        r.send();
    }
}

function basicSearch(x) {

    var text = document.getElementById("text").value;
    var select = document.getElementById("cat").value;

    var f = new FormData();
    f.append("text", text);
    f.append("cat", select);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("basicSearchResult").innerHTML = t;
        }
    }

    r.open("POST", "basicSearchprocess.php", true);
    r.send(f);

}

function sort(x) {

    var search = document.getElementById("s");
    var cat = document.getElementById("cat");
    var time = 0;

    if (document.getElementById("n").checked) {
        time = "1";
    } else if (document.getElementById("o").checked) {
        time = "2"
    }

    var price = 0;

    if (document.getElementById("h").checked) {
        price = "1";
    } else if (document.getElementById("l").checked) {
        price = "2"
    }

    var f = new FormData();
    f.append("s", search.value);
    f.append("t", time);
    f.append("p", price);
    f.append("c", cat.value);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("sort").innerHTML = t;
        }
    }

    r.open("POST", "shortProcess.php", true);
    r.send(f);
}

function advancedSearch(x) {


    var price_from = document.getElementById("pf");
    var price_to = document.getElementById("ft");
    var categoty = document.getElementById("cat");
    var txt = document.getElementById("key");
    var sort = document.getElementById("s");

    var f = new FormData();
    f.append("pf", price_from.value);
    f.append("pt", price_to.value);
    f.append("c", categoty.value);
    f.append("t", txt.value);
    f.append("s", sort.value);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            if (t != 'doNothing') {
                document.getElementById("view_area").innerHTML = t;
            }


        }
    }

    r.open("POST", "advancedSearchprocess.php", true);
    r.send(f);

}

function addtowatchlist(x) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;

            if (t == 1) {
                alert("Product added to the watchlist successfully");
                // window.location.reload();

            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "addtowatchlistprocess.php?id=" + x, true);
    r.send();
}

function removetocart(x) {

    if (confirm("Do You Want to Remove This Product") == true) {
        var r = new XMLHttpRequest();

        r.onreadystatechange = function () {
            if (r.status == 200 && r.readyState == 4) {
                var t = r.responseText;
                if (t == 1) {

                    window.location.reload();
                } else {
                    alert(t);
                }

            }
        }
    }

    r.open("GET", "removewatchlist.php?id=" + x, true);
    r.send();

}

function findlist(x) {
    var text = document.getElementById("text").value;

    var f = new FormData();
    f.append("txt", text);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            //alert(t);
            if (t != 'doNothing') {
                document.getElementById("view_area").innerHTML = t;
            }


        }
    }

    r.open("POST", "findtowatchlistprocess.php", true);
    r.send(f);

}

function viweall(c) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("basicSearchResult").innerHTML = t;
            window.scrollTo({
                top: 0,
                behavior: 'instant'
            });
        }
    }

    r.open("GET", "viweall.php?cat=" + c, true);
    r.send();
}

function addtocart(pid) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;

            if (t == 1) {

                window.location = "cart.php";

            } else {

                alert(t);

            }


        }
    }

    r.open("GET", "addtocartprocess.php?id=" + pid, true);
    r.send();
}

// buynow Button Actions
function buyNow(pid) {

    var qty = document.getElementById("qty_play");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            if (t == 1) {
                window.location = "cart.php";
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "addtocartprocess.php?id=" + pid + "&st=" + 1 + "&qty=" + qty.value, true);
    r.send();
}

function removecart(pid) {

    if (confirm("Do you want to remove this product") == true) {
        var r = new XMLHttpRequest();

        r.onreadystatechange = function () {
            if (r.status == 200 && r.readyState == 4) {
                var t = r.responseText;
                if (t == 1) {
                    // alert("Products have been removed");
                    window.location.reload();
                } else {
                    alert(t);
                }

            }
        }

        r.open("GET", "removetocartprocess.php?id=" + pid, true);
        r.send();
    }

}

function cart_qty_inc(qty, i, pid) {

    var input = document.getElementById("qty_play" + i);

    if (qty > input.value) {

        var new_value = parseInt(input.value) + 1;
        input.value = new_value;
        qtyprocess(i, pid);


    } else {

        alert("You have reched to the Maximum");
        input.value = qty;
    }

}

function cart_qty_dec(i, pid) {

    var input = document.getElementById("qty_play" + i);

    if (1 < input.value) {

        var new_value = parseInt(input.value) - 1;
        input.value = new_value;
        qtyprocess(i, pid);

    } else {

        alert("You have reched to the Minimum");
        input.value = 1;
    }
}

function qtyprocess(i, pid) {

    var qty = parseInt(document.getElementById("qty_play" + i).value);
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            if (t == 1) {
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "qtyprocess.php?qty=" + qty + "&pid=" + pid, true);
    r.send();

}

function paycart() {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            if (t == "NO_ADDERSS") {
                alert("Please update your address information.");
                window.location = "userProfileUpdate.php";
            } else {

                var obj = JSON.parse(t);

                var umail = obj["umail"];
                var amount = obj["amount"];

                // Payment completed. It can be a successful failure.
                payhere.onCompleted = function onCompleted(orderId) {
                    console.log("Payment completed. OrderID:" + orderId);

                    updateCart(orderId);
                    // saveInvoice(orderId);



                    // Note: validate the payment and show success or failure page to the customer
                };

                // Payment window closed
                payhere.onDismissed = function onDismissed() {
                    // Note: Prompt user to pay again or show an error page
                    console.log("Payment dismissed");
                };

                // Error occurred
                payhere.onError = function onError(error) {
                    // Note: show an error page
                    console.log("Error:" + error);
                };

                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": "1224007",    // Replace your Merchant ID
                    "return_url": "http://localhost/haritha/cart.php",     // Important
                    "cancel_url": "http://localhost/haritha/cart.php",     // Important
                    "notify_url": "http://sample.com/notify",
                    "order_id": obj["id"],
                    "items": obj["item"],
                    "amount": amount,
                    "currency": "LKR",
                    "hash": obj["hash"], // *Replace with generated hash retrieved from backend
                    "first_name": obj["fname"],
                    "last_name": obj["lname"],
                    "email": umail,
                    "phone": obj["mobile"],
                    "address": obj["address"],
                    "city": obj["city"],
                    "country": "Sri Lanka",
                    "delivery_address": obj["address"],
                    "delivery_city": obj["city"],
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };

                // Show the payhere.js popup, when "PayHere Pay" is clicked
                // document.getElementById('payhere-payment').onclick = function (e) {
                payhere.startPayment(payment);
                // }

            }
        }
    }

    r.open("GET", "cartpayprocess.php?", true);
    r.send();

}

function updateCart(order_id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            if (t == "Done") {

                saveInvoice(order_id);

            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "updatecartprocess.php?order_id=" + order_id, true);
    r.send();

}

function sendfeedback() {
    var pid = document.getElementById("pid");
    var text = document.getElementById("text");
    var pimg = document.getElementById("pimg");

    var f = new FormData();
    f.append("pid", pid.value);
    f.append("text", text.value);
    f.append("pimg", pimg.files[0]);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t == "OK") {
                alert("Thank You For Your Feedback");
                window.location = "userProfile.php";
            } else {
                alert(t);
            }

        }
    }

    r.open("POST", "feedbackprocess.php", true);
    r.send(f);
}

function viewfeed(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            if (t == 1) {

                window.location = "singlefeed.php?id=" + id;

            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "viwefeedprocess.php?id=" + id, true);
    r.send();

}

function changeUserStatus(email) {

    var f = new FormData();
    f.append("email", email);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t == 'OK') {
                window.location.reload();
            } else {
                alert(t);
            }

        }
    }

    r.open("POST", "changeUserStatusprocess.php", true);
    r.send(f);
}

function printInvoice() {
    var restorepage = document.body.innerHTML;
    var page = document.getElementById("page").innerHTML;
    document.body.innerHTML = page;
    window.print();
    document.body.innerHTML = restorepage;
}

function usort(x) {
    var text = document.getElementById("s");
    var time = 0;
    if (document.getElementById("new").checked) {
        time = "1";
    } else if (document.getElementById("old").checked) {
        time = "2"
    }

    // var qty = 0;
    // if (document.getElementById("high").checked) {
    //     qty = "1";
    // } else if (document.getElementById("low").checked) {
    //     qty = "2"
    // }

    var statu = 0;
    if (document.getElementById("all").checked) {
        statu = "1";
    } else if (document.getElementById("active").checked) {
        statu = "2";
    } else if (document.getElementById("blocked").checked) {
        statu = "3";
    }

    var f = new FormData();
    f.append("txt", text.value);
    f.append("tim", time);
    // f.append("qty", qty);
    f.append("st", statu);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("sort").innerHTML = t;
        }
    }

    r.open("POST", "userShortProcess.php", true);
    r.send(f);
}

function removeFeed(x) {

    if (confirm("Do you want to remove this Feed") == true) {

        var r = new XMLHttpRequest();

        r.onreadystatechange = function () {
            if (r.status == 200 && r.readyState == 4) {
                var t = r.responseText;
                if (t == "Done") {
                    window.history.back();
                } else {
                    alert(t);
                }
            }
        }

        r.open("GET", "removeFeed.php? id=" + x, true);
        r.send();

    }

}

function deleteHistory(x) {

    alert("coming soon");

    // if (confirm("Do you want to remove") == true) {

    //     var r = new XMLHttpRequest();

    //     r.onreadystatechange = function () {
    //         if (r.status == 200 && r.readyState == 4) {
    //             var t = r.responseText;
    //             if (t == "Done") {
    //                 window.location.reload();
    //             } else {
    //                 alert(t);
    //             }
    //         }
    //     }

    //     r.open("GET", "userHistoryDelete.php?d=" + x, true);
    //     r.send();

    // }

}

// function changeSt(oid) {

//     $file = document.getElementById["dfile"];

//     if (confirm("Do you want to accept the order?") == true) {

//         var r = new XMLHttpRequest();

//         r.onreadystatechange = function () {
//             if (r.status == 200 && r.readyState == 4) {
//                 var t = r.responseText;
//                 if (t == "Done_0") {
//                     alert("status changed");
//                     window.location = 'order.view.php?st=0';
//                 } else if (t == "Done_1") {
//                     alert("status changed");
//                     window.location = 'order.view.php?st=1';
//                 }else{
//                     alert(t);
//                 }
//             }
//         }

//         r.open("GET", "changeStats.php?oid=" + oid, true);
//         r.send();

//     }

// }

function changeSt(oid, x) {

    $file = document.getElementById["dfile"];

    if (confirm("Do you want to accept the order?") == true) {

        var r = new XMLHttpRequest();

        r.onreadystatechange = function () {
            if (r.status == 200 && r.readyState == 4) {
                var t = r.responseText;
                var obj = JSON.parse(t);
                sendEmail(obj);
            }
        }

        r.open("GET", "changeStats.php?oid=" + oid + "&st=" + x, true);
        r.send();
    }
}

function sendEmail(obj) {

    if (confirm("Do you want to send a mail to usre") == true) {

        var email = obj["email"];
        var title = obj["title"];
        var msg = obj["msg"];
        // var id = obj["id"];

        var f = new FormData();
        f.append("email", email);
        f.append("title", title);
        f.append("msg", msg);
        // f.append("id",id);

        var r = new XMLHttpRequest();

        r.onreadystatechange = function () {
            if (r.status == 200 && r.readyState == 4) {
                var t = r.responseText;
                if (t == "Good") {
                    alert("Message sent");
                    window.history.back();

                } else {
                    alert(t);
                    window.history.back();
                }
            }
        }

        r.open("POST", "mailSend.php", true);
        r.send(f);

    } else {
        window.history.back();
    }
}

function getReport(report) {
    var reportType = document.getElementById(report).value;
    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t != 'Unauthorized Access') {
                var printWindow = window.open('', '_blank');
                printWindow.document.write(t);
                printWindow.document.close();
                printWindow.print();
            }else{
              alert("Unauthorized Access");  
            }
        }
    };
    r.open("GET", "reportProcess.php?reportType=" + reportType, true);
    r.send();
}

