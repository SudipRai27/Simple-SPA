class Storage {
    setItem(key, value) {
        return localStorage.setItem(key, value);
    }

    retrieveItem(key) {
        return localStorage.getItem(key);
    }

    destroyItem(key) {
        return localStorage.removeItem(key);
    }
}
const storage = new Storage();
export default storage;
