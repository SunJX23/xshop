import { isMoblie } from '../src/utils'

const place = 'home'

let host = isMoblie() ? '192.168.2.30' : 'localhost'
host = place === 'company' ? host : 'localhost'
let header = place === 'company' ? 'http://' + host : 'http://myphp.com'
export const FRONT_DOMAIN = 'http://' + host + ':8080/#/'
export const BACK_DOMAIN = header + '/xshop/backEnd/public/'