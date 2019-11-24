import Battle from "../../models/Battle";
import { post } from "../../api";

export const encount = async () => await post<Battle>("/battle");
