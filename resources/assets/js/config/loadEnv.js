let env = null
import dev from './development'
import prod from './production'
if(process.env.NODE_ENV === 'development'){
  env = dev
}
if(process.env.NODE_ENV === 'production'){
  env = prod
}

export default env
