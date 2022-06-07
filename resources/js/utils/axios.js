import axios from "axios";
import { user } from '../stores.js';

export const axiosClient = axios.create({
    headers: { Authorization : `Bearer ${user.value.token}` }
})