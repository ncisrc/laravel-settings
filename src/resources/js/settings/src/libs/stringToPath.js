export default function stringToPath(items) {
  var rAry = [];
  items.forEach(item => recursivePathFinder("", item.code, rAry));
  return rAry;
}

function recursivePathFinder(prefix, code, ary) {
  const codePath = code.split('.');
  const name = codePath[0];
  const fullname = (prefix == '') ? name : `${prefix}.${name}`;

  // On recherche si l'item existe déjà dans le tableau
  let item = ary.find(item => item.key == fullname);

  // Sinon on le crée et on l'ajoute au tableau
  if (!item) {
    item = {
      key : fullname,
      label : `settings.menu.${fullname}_label`,
      children : []
    }
    ary.push(item);
  }

  // Puis on parse les suivants si c'est nécessaire
  if (codePath.length > 2) {
    const nextCode = codePath.splice(1).join('.');
    recursivePathFinder(fullname, nextCode, item.children)
  }
}
