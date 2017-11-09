const encodeAttribute = (x = '') => x.replace(/"/g, '&quot;')

const toAttributeString = (x = {}) =>
    Object.keys(x)
        .map(attr => `${encodeAttribute(attr)}="${encodeAttribute(x[attr])}`)
        .join(' ')

const tagAttributes = x => (c = '') =>
    `<${x.tag}${x.attr?' ':''}${toAttributeString(x.attr)}>${c}</${x.tag}>`

const tag = x =>
    typeof x === 'string'
        ? tagAttributes({ tag: x })
        : tagAttributes(x)

module.exports = tag;