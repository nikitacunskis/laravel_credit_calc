export function validatePhoneNumber(country, number) {
    const phoneRules = {
      lv: /^2\d{7}$/,
      ee: /^5\d{7}$/,
      lt: /^6\d{7}$/,
    };
  
    return phoneRules[country]?.test(number) || false;
  }
  