
// 验证是否为移动端
export function isMoblie () {
  return (navigator.userAgent.match(/(iPhone|iPod|Android|ios|iPad)/i))
}

/******************************表单验证*******************************/

// 验证字符串只能英文，数字，下划线组成
export const validName1 = (rule, value, callback) => {
  if (!value) callback()
  const reg = /^[a-zA-Z0-9_]{3,10}$/
  let test = reg.test(value)
  test ? callback() : callback(new Error('请输入英文/数字/下划线'))
  return test
}

// 验证字符串只能英文，下划线开头，配合上述
export const validName2 = (rule, value, callback) => {
  if (!value) callback()
  const reg = /^[a-zA-Z_]+[a-zA-Z0-9_]{2,10}$/
  let test = reg.test(value)
  test ? callback() : callback(new Error('不可用数字开头'))
  return test
}

// 验证字符串只能英文，数字，下划线组成，长度在3-30之间（密码）
export const validName3 = (rule, value, callback) => {
  if (!value) callback()
  const reg = /^[a-zA-Z0-9_]{6,30}$/
  let test = reg.test(value)
  test ? callback() : callback(new Error('请输入英文/数字/下划线'))
  return test
}

// 验证字符串只能是中文，英文，下划线，数字，长度在2-13之间
export const validName4 = (rule, value, callback) => {
  if (!value) callback()
  const reg = /^[a-zA-Z0-9_\u4e00-\u9fa5]{2,13}$/
  let test = reg.test(value)
  test ? callback() : callback(new Error('长度在2-13之间'))
  return test
}


export const clone = function (obj) {
	if (typeof obj !== 'object') return obj;
	let new_obj = Array.isArray(obj) ? [] : {}
	for (let i in obj) {
		new_obj[i] = XXX.clone(obj[i]);
	}
	return new_obj
}


// promise图片下载示例
function imgLoad(url) {
  // Create new promise with the Promise() constructor;
  // This has as its argument a function
  // with two parameters, resolve and reject
  return new Promise(function(resolve, reject) {
    // Standard XHR to load an image
    var request = new XMLHttpRequest();
    request.open('GET', url);
    request.responseType = 'blob';
    // When the request loads, check whether it was successful
    request.onload = function() {
      if (request.status === 200) {
        // If successful, resolve the promise by passing back the request response
        resolve(request.response);
      } else {
        // If it fails, reject the promise with a error message
        reject(Error('Image didn\'t load successfully; error code:' + request.statusText));
      }
    };
    request.onerror = function() {
      // Also deal with the case when the entire request fails to begin with
      // This is probably a network error, so reject the promise with an appropriate message
      reject(Error('There was a network error.'));
    };
    // Send the request
    request.send();
  });
}

function test() {
  // Get a reference to the body element, and create a new image object
  var body = document.querySelector('body');
  var myImage = new Image();
  // Call the function with the URL we want to load, but then chain the
  // promise then() method on to the end of it. This contains two callbacks
  imgLoad('myLittleVader.jpg').then(function(response) {
      // The first runs when the promise resolves, with the request.reponse
      // specified within the resolve() method.
      var imageURL = window.URL.createObjectURL(response);
      myImage.src = imageURL;
      body.appendChild(myImage);
      // The second runs when the promise
      // is rejected, and logs the Error specified with the reject() method.
    }, function(Error) {
      console.log(Error);
    }
  );
}