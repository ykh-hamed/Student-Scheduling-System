        var userName;
        var exp;

        function start() {
            document.getElementById("loginButton").addEventListener("click", userNameCheck);
        }

        function userNameCheck(evt) {
            userName = document.getElementById("userName").value;
            if (!/^[a-z0-9]+$/i.test(userName)) {
                alert("Invalid username.")
                evt.preventDefault();
                return false;
            }
        }
        window.addEventListener("load", start, false);