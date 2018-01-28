
export const getHeader= ()=>{
   const token_data = JSON.parse(window.localStorage.getItem('authUser'));
   return {
     Accept:'application/json',
     Authorization:'Bearer '+ token_data.access_token
   }
}