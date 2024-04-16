import axios from 'axios'

const axios_instance = axios.create({
  baseURL: 'http://localhost:80/PHP_RestFul_API/',
  headers: {
    accept: 'application/json'
  }
});
export default axios_instance;