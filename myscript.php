<script type="module">
// Import the functions you need from the SDKs you need
import {
    initializeApp
} from "https://www.gstatic.com/firebasejs/9.8.2/firebase-app.js";
// import { getAuth, createUserWithEmailAndPassword } from "firebase/auth";
import {
    getAuth,
    createUserWithEmailAndPassword,
    signInWithEmailAndPassword,
    signOut
} from "https://www.gstatic.com/firebasejs/9.8.2/firebase-auth.js";
import {
    getDatabase,
    set,
    ref,
    get,
    update
} from "https://www.gstatic.com/firebasejs/9.8.2/firebase-database.js";
// import { getDatabase } from "firebase/database";

// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
const firebaseConfig = {
    apiKey: "AIzaSyCl187TfdE2U96gwo_Wg7HToa0YmRV5wWk",
    authDomain: "rageman-orders.firebaseapp.com",
    databaseURL: "https://rageman-orders-default-rtdb.firebaseio.com",
    projectId: "rageman-orders",
    storageBucket: "rageman-orders.appspot.com",
    messagingSenderId: "998695493444",
    appId: "1:998695493444:web:a10201af4430f73e414111"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const auth = getAuth(app);
const database = getDatabase(app);
let signinButton = document.getElementById("signin-button");
let signupButton = document.getElementById("signup-button");

signupButton.addEventListener("click", (e) => {
    let name = document.getElementById("name").value;
    let nohp = document.getElementById("nohp").value;
    let emailSignup = document.getElementById("email_signup").value;
    let passwordSignup = document.getElementById("psw_signup").value;
    let kategori = document.getElementById("kategori").value;

    createUserWithEmailAndPassword(auth, emailSignup, passwordSignup)
        .then((userCredential) => {
            // Signed in
            const user = userCredential.user;

            set(ref(database, "users/" + user.uid), {
                    name: name,
                    nohp: nohp,
                    email: emailSignup,
                    password: passwordSignup,
                    kategori: kategori
                })
                .then(() => {
                    // Data saved successfully!
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Users behasil dibuat.",
                        showConfirmButton: false,
                        timer: 1500
                    });
                })
                .catch((error) => {
                    //the write failed
                    alert(error);
                });
        })
        .catch((error) => {
            const errorCode = error.code;
            const errorMessage = error.message;
            alert(errorMessage);
        });
});

signinButton.addEventListener("click", (e) => {
    let emailSignin = document.getElementById("email_signin").value;
    let passwordSignin = document.getElementById("psw_signin").value;

    signInWithEmailAndPassword(auth, emailSignin, passwordSignin)
        .then((userCredential) => {
            const user = userCredential.user;

            const userRef = ref(database, "users/" + user.uid);
            get(userRef)
                .then((snapshot) => {
                    if (snapshot.exists()) {
                        const userData = snapshot.val();
                        const userCategory = userData.kategori;

                        let lgDate = new Date();
                        update(userRef, {
                                last_login: lgDate
                            })
                            .then(() => {
                                // Data saved successfully!
                                if (userCategory === "Admin") {
                                  alert("Login Success");
                                    location.href = "index_admin.php?x=dashboard";
                                } else if (userCategory === "Kasir") {
                                  alert("Login Success");
                                    location.href = "index_kasir.php?x=dashboard";
                                } else if (userCategory === "Dapur") {
                                  alert("Login Success");
                                    location.href = "index_dapur.php?x=dashboard";
                                } else {
                                    // Handle other categories or redirect to a default page
                                    alert("Unknown category. Redirecting to default page.");
                                    
                                }
                            })
                            .catch((error) => {
                                // The write failed
                                alert(error);
                            });
                    } else {
                        // User data not found
                        alert("User data not found.");
                    }
                })
                .catch((error) => {
                    // Error getting user data
                    alert(error);
                });
        })
        .catch((error) => {
            const errorCode = error.code;
            const errorMessage = error.message;
            alert(errorMessage);
        });
});
</script>