export async function apiFetch(input: RequestInfo, init: RequestInit = {}) {
  const token = localStorage.getItem('magic_token')
  const headers = new Headers(init.headers || {})

  if (token) {
    headers.set('Authorization', `Bearer ${token}`)
  }

  const url = typeof input === 'string' && !input.startsWith('http')
    ? `${import.meta.env.VITE_API_URL}${input}`
    : input

  const response = await fetch(url, {
    ...init,
    headers,
  })

  if (response.status === 401 || response.status === 403) {
    localStorage.removeItem('magic_token')
    localStorage.removeItem('magic_link')
    localStorage.removeItem('user')

    window.location.href = '/'

    return
  }

  if (!response.ok && response.status !== 422) {
    throw new Error(`HTTP error! status: ${response.status}`)
  }

  const contentLength = response.headers.get('content-length')
  const contentType = response.headers.get('content-type')

  if (
    response.status === 204
    || contentLength === '0'
    || !contentType?.includes('application/json')
  ) {
    return null
  }

  return response.json()
}
