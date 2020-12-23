export default function(url, callback) {
  const at = document.getElementsByTagName("script")[0];
  const script = document.createElement('script');
  script.src = url;
  at.parentNode.insertBefore(script, at);

  script.onload = () => {
    if (callback) callback();
  };
}
