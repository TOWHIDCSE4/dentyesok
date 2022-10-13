import moment from 'moment';
import {COM_STATUS} from "./constant";

export function formatNumber(number) {
    if (!number) return 0;
    let before = '';
    if (parseInt(number)<0) {
        number = Math.abs(number);
        before = '-';
    }
    number = number.toString().replace(/,/g, '');
    return before + number.replace(/(.)(?=(\d{3})+$)/g,'$1,');
}
export function dateFormat(date) {
    if ( !date ) return '-';
    return moment(date).format('YYYY/MM/DD')
}
export function comStatus(status) {
    switch (status) {
        case COM_STATUS.NOT_READY:
            return "Not Ready";
        case COM_STATUS.FREE_TRIAL:
            return "Free Trial";
        case COM_STATUS.ACTIVATE:
            return "Active";
    }
}