import java.util.ArrayList;

class Flags {
    private ArrayList<Integer> peaks = new ArrayList<Integer>();

    public int solution(int[] A) {
        findPeaks(A);
        int L = A.length;
        if (peaks.size() < 1) return 0;

        int lo = 0;
        int hi = L - 1;
        while (lo <= hi) {
            int mid = lo + (hi - lo) / 2;
            if (check(mid, A)) lo = mid + 1;
            else hi = mid - 1;
        }
        return lo-1;
    }

    private void findPeaks(int[] A) {
        int L = A.length;
        for (int i = 1; i < L-1; i++) {
            if (A[i-1] < A[i] && A[i] > A[i+1]) {
                peaks.add(i);
            }
        }
    }

    private boolean check(int x, int[] A) {
        int pos = peaks.get(0);
        int flags = x;
        int L = A.length;
        while (pos < L && flags > 0) {
            if (peaks.contains(pos)) {
                flags--;
                pos += x;
            } else {
                pos++;
            }
        }

        return flags == 0;
    }

    public static void main(String[] args) {
        Flags f = new Flags();
        int[] A = new int[] {5};
        System.out.println(f.solution(A));
    }
}