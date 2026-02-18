import { initializeApp } from "https://www.gstatic.com/firebasejs/10.8.1/firebase-app.js";
import { getDatabase, ref, set, push, onValue, remove, update } from "https://www.gstatic.com/firebasejs/10.8.1/firebase-database.js";

const firebaseConfig = {
  apiKey: "AIzaSyBBh59DxELiz-WmP43vgeZF4oLg2cMc67c",
  authDomain: "satriamail-684f1.firebaseapp.com",
  databaseURL: "https://satriamail-684f1-default-rtdb.asia-southeast1.firebasedatabase.app",
  projectId: "satriamail-684f1",
  storageBucket: "satriamail-684f1.firebasestorage.app",
  messagingSenderId: "950841103392",
  appId: "1:950841103392:web:ac7c4bbb18da2063c39845"
};

const app = initializeApp(firebaseConfig);
const db = getDatabase(app);

export { db, ref, set, push, onValue, remove, update };